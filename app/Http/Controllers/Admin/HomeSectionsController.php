<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Homesection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeSectionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
        $user = Auth::User();
        Session::put('user', $user);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Homesection::all();
        return view('backend.homesections.list', compact('sections'));

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
        //
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
    public function edit($id, $section)
    {
        $value = Homesection::all()->where('id', $id)->firstOrFail();
        return view('backend.homesections.edit', compact('value', 'section'));
    }

    private function validateRequest(Request $request)
    {

        if ($request->section == 1) {

            $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required',
            ];

            foreach ($languages as $lang) {
                $rules["title_{$lang}"] = 'required|string|max:255';
                $rules["description_{$lang}"] = 'required';
            }

            return Validator::make($request->all(), $rules, [
                'required' => ':attribute alanı gereklidir.',
                'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
                'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
                'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
                'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
            ]);

        }
        if ($request->section == 2) {
            $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
            $rules = [
                'title' => 'required|string|max:255',
                'description' => 'required',
                'btnText' => 'required|string|max:255',
                'url' => 'required|string|max:255',
            ];

            if ($request->hasFile('image')) {
                dd($request->all());
                $rules['image'] = 'image|mimes:jpeg,png,jpg|dimensions_multiple:1000,1000';
            }
            foreach ($languages as $lang) {
                $rules["title_{$lang}"] = 'required|string|max:255';
                $rules["description_{$lang}"] = 'required';
                $rules["btnText_{$lang}"] = 'required|string|max:255';
                $rules["url_{$lang}"] = 'required|string|max:255';
            }
            return Validator::make($request->all(), $rules, [
                'required' => ':attribute alanı gereklidir.',
                'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
                'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
                'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
                'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
            ]);
        }
        if ($request->section == 4) {
            $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
            $rules = [
                'title' => 'required|string|max:255',
                'btnText' => 'required|string|max:255',
                'url' => 'required|string|max:255',
            ];
            if ($request->hasFile('image')) {
                $rules['image'] = 'image|mimes:jpeg,png,jpg|dimensions_multiple:2000,2000';
            }
            foreach ($languages as $lang) {
                $rules["title_{$lang}"] = 'required|string|max:255';
                $rules["btnText_{$lang}"] = 'required|string|max:255';
                $rules["url_{$lang}"] = 'required|string|max:255';
            }
        }
        return Validator::make($request->all(), $rules, [
            'required' => ':attribute alanı gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
            'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ]);

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

        // Validasyon
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {

            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        // Güncellenecek kaydı getir
        $root = Homesection::findOrFail($id);

        // Resim kontrolü ve kaydetme işlemi
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($root->image) {
                __deleteImage($root->image);
            }

            if ($request->file('image')->getSize() > 2048 * 1024) { // 2 MB
                \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
                return back()->withErrors(['image' => 'Yüklenen dosya 2 MB\'ı geçemez.']);
            }

            if ($request->section == 2) {

                $imagePath = __webp($request->file('image'), 'homesections', 1000, 1000);
            } elseif ($request->section == 4) {
                // Yeni resmi kaydet
                $imagePath = __webp($request->file('image'), 'homesections', 2000, 2000);
            }
            $root->image = $imagePath;
        }

        // Diğer verileri al
        $data = $request->except('image');

        // Modeli güncelle
        $root->update($data);

        // Değişiklikleri kaydet
        $root->save();

        toast('Bölüm Başarıyla Güncellendi', 'success');
        return redirect()->route('homesections.index');
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
