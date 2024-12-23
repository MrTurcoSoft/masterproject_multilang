<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SectionTab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SiteHelpers;

class SectiontabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = SectionTab::all();
        return view('backend.homesectiontabs.list', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Form validation
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'btnText' => 'required',
            'url' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=600,min_height=600,max_width=600,max_height=600'
        ];

        $customMessages = [
            'required' => ':attribute girişi gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg,png,jpg,gif,svg uzantılı resim dosyası yükleyebilirsiniz! ',
            'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
            'dimensions' => 'Yüklediğiniz resmin Genişliği 600 px x Yüksekliği 600 px olmalıdır.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }


        Validator::replacer('custom_validation_rule', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':foo', $parameters[0], $message);
        });

        $requestData = $request->all();
        $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('images/sectiontabs', $fileName, 'public');
        $requestData['image'] = '/storage/' . $path;

        SectionTab::create($requestData);
        toast('Tab Başarıyla Kaydedildi', 'success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $value = SectionTab::all()->where('id', $id)->firstOrFail();
        return view('backend.homesectiontabs.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Diğer verileri al
        $data = $request->except('image');
        // Form validation
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'btnText' => 'required',
            'url' => 'required',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|dimensions_multiple:600,600';
        }
        foreach ($languages as $lang) {
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["btnText_{$lang}"] = 'required|string|max:255';
            $rules["url_{$lang}"] = 'required|string|max:255';
        }
        $customMessages = [
            'required' => ':attribute girişi gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg,png,jpg,gif,svg uzantılı resim dosyası yükleyebilirsiniz! ',
            'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }
        $root = SectionTab::findOrFail($id);

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($root->image) {
                __deleteImage($root->image);
            }

            if ($request->file('image')->getSize() > 2048 * 1024) { // 2 MB
                \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
                return back()->withErrors(['image' => 'Yüklenen dosya 2 MB\'ı geçemez.']);
            }
            $data['image'] = __webp($request->file('image'), 'sectiontabs', 600, 600);
        }

            // Modeli güncelle
            $root->update($data);

            // Değişiklikleri kaydet
            $root->save();

            toast('Tab Başarıyla Güncellendi', 'success');
            return redirect()->route('sectiontabs.index');

        }




    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
