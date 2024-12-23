<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SiteHelpers;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $slider = Slider::all();
        return view('backend.slider.list', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.slider.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        // Desteklenen diğer dillerin listesi
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];

        // Validasyon kuralları
        $rules = [
            // İngilizce için alanlar
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'content2' => 'required|string|max:255',
            'btnText' => 'required|string|max:255',
            'url' => 'required',
            // Resim için validasyon
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions_multiple:1920,1280'
        ];

        // Diğer diller için döngü
        foreach ($languages as $lang) {
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["content_{$lang}"] = 'required|string|max:255';
            $rules["content2_{$lang}"] = 'required|string|max:255';
            $rules["btnText_{$lang}"] = 'required|string|max:255';
            $rules["url_{$lang}"] = 'required';
        }

        // Özelleştirilmiş hata mesajları
        $customMessages = [
            'required' => ':attribute alanı gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
            'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];

        // Validasyon
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }


        $requestData['image'] = __webp($request->file('image'),'sliders',1920,1280);
       // dd($requestData); // Burada form verilerinin eksiksiz olduğunu kontrol edin.
        // Slider kaydet
        Slider::create($requestData);

        toast('Slider başarıyla kaydedildi!', 'success');
        return redirect()->route('slider-management.index');
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

        $value = Slider::all()->where('id', $id)->firstOrFail();
        return view('backend.slider.edit', compact('value'));
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
        // Güncellenen slider'ı bul
        $slider = Slider::findOrFail($id);

        // Desteklenen diğer dillerin listesi
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];

        // Validasyon kuralları
        $rules = [
            // İngilizce için alanlar
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'content2' => 'required|string|max:255',
            'btnText' => 'required|string|max:255',
            'url' => 'required',
            // Resim için validasyon
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions_multiple:1920,1280'
        ];

        // Diğer diller için döngü
        foreach ($languages as $lang) {
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["content_{$lang}"] = 'required|string|max:255';
            $rules["content2_{$lang}"] = 'required|string|max:255';
            $rules["btnText_{$lang}"] = 'required|string|max:255';
            $rules["url_{$lang}"] = 'required';
        }

        // Özelleştirilmiş hata mesajları
        $customMessages = [
            'required' => ':attribute alanı gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
            'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];

        // Validasyon
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        // Bilgiler güncellenirse
        if ($request->hasAny(['title', 'content', 'content2', 'btnText', 'url', 'isActive'])) {
            $slider->title = $request->input('title', $slider->title);
            $slider->content = $request->input('content', $slider->content);
            $slider->content2 = $request->input('content2', $slider->content2);
            $slider->btnText = $request->input('btnText', $slider->btnText);
            $slider->url = $request->input('url', $slider->url);
            $slider->isActive = $request->input('isActive', $slider->isActive);
        }

        // Resim güncellenirse
        if ($request->hasFile('image')) {
            // Eski resmi sil
            if (!empty($slider->image)) {
                __deleteImage($slider);
            }

            // Yeni resmi kaydet
            $fileName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('images/sliders', $fileName, 'public');
            $slider->image = '/storage/' . $path;
        }

        // Değişiklikleri kaydet
        $slider->save();

        // Başarı mesajı ve yönlendirme
        toast('Slider başarıyla güncellendi', 'success');
        return redirect()->route('slider-management.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $slider = Slider::find($id);
        if ($slider) {
            __deleteImage($slider);
            $slider->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }


}
