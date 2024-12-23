<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SiteHelpers;

class AboutController extends Controller
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
        $value = About::firstOrFail();
        return view('backend.about.edit', compact('value'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

        $value = About::firstOrFail();
        return view('backend.about.edit', compact('value'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //dd($request->all());
        if ($request->bg) {
            // Form validation
            $rules = [
                'bg' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=1080,min_height=1080,max_width=1080,max_height=1080'
            ];

            $customMessages = [
                'required' => ':attribute girişi gereklidir.',
                'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
                'mimes' => 'Sadece jpeg,png,jpg uzantılı resim dosyası yükleyebilirsiniz! ',
                'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
                'dimensions' => 'Yüklediğiniz resmin Genişliği 1080 px x Yüksekliği 1080 px olmalıdır.'
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
                return back();
            }

            // Resmi işleme ve webp formatına dönüştürme
            $imageFile = $request->file('bg');
            $fileName = time() . '.webp'; // Yeni dosya adı ve uzantısı
            $path = 'images/about/' . $fileName;

            // Intervention Image ile resmi işleme
            $image = \Image::make($imageFile)
                ->encode('webp', 90) // Webp formatına çevir ve kaliteyi %90 ayarla
                ->resize(1080, 1080) // Gerekirse boyutlandır
                ->save(public_path('storage/' . $path)); // Kaydet

            // Eski dosyayı sil ve yeni yolu kaydet
            $root = About::findOrFail($id);
            File::delete(public_path($root->bg)); // Eski resmi sil
            $root->bg = '/storage/' . $path;
            $root->save();

            toast('Header Arka Planı Başarıyla Güncellendi', 'success');
            return back();
        } elseif ($request->image) {
            // Form validation
            $rules = [
                'image' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=3000,min_height=3000,max_width=3000,max_height=3000'
            ];

            $customMessages = [
                'required' => ':attribute girişi gereklidir.',
                'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
                'mimes' => 'Sadece jpeg,png,jpg uzantılı resim dosyası yükleyebilirsiniz! ',
                'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
                'dimensions' => 'Yüklediğiniz resmin Genişliği 3000 px x Yüksekliği 3000 px olmalıdır.'
            ];

            $validator = Validator::make($request->all(), $rules, $customMessages);
            if ($validator->fails()) {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
                return back();
            }

            // Resmi işleme ve webp formatına dönüştürme
            $imageFile = $request->file('image');
            $fileName = time() . '.webp'; // Yeni dosya adı ve uzantısı
            $path = 'images/about/' . $fileName;

            // Intervention Image ile resmi işleme
            $image = \Image::make($imageFile)
                ->encode('webp', 90) // Webp formatına çevir ve kaliteyi %90 ayarla
                ->resize(3000, 3000) // Gerekirse boyutlandır
                ->save(public_path('storage/' . $path)); // Kaydet

            // Eski dosyayı sil ve yeni yolu kaydet
            $root = About::findOrFail($id);
            File::delete(public_path($root->image)); // Eski resmi sil
            $root->image = '/storage/' . $path;
            $root->save();

            toast('Hakkımızda Resmi Başarıyla Güncellendi', 'success');
            return back();
        } else {

            // Form verilerini doğrula
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'page_title' => 'required',
                'page_description' => 'required',
                'page_keywords' => 'required',
                'name_de' => 'required',
                'description_de' => 'required',
                'page_title_de' => 'required',
                'page_description_de' => 'required',
                'page_keywords_de' => 'required',
                'name_es' => 'required',
                'description_es' => 'required',
                'page_title_es' => 'required',
                'page_description_es' => 'required',
                'page_keywords_es' => 'required',
                'name_fr' => 'required',
                'description_fr' => 'required',
                'page_title_fr' => 'required',
                'page_description_fr' => 'required',
                'page_keywords_fr' => 'required',
                'name_hu' => 'required',
                'description_hu' => 'required',
                'page_title_hu' => 'required',
                'page_description_hu' => 'required',
                'page_keywords_hu' => 'required',
                'name_it' => 'required',
                'description_it' => 'required',
                'page_title_it' => 'required',
                'page_description_it' => 'required',
                'page_keywords_it' => 'required',
                'name_sr' => 'required',
                'description_sr' => 'required',
                'page_title_sr' => 'required',
                'page_description_sr' => 'required',
                'page_keywords_sr' => 'required',

            ];
            $customMessages = [
                'required' => ':attribute alanı zorunludur.',
            ];
            $validator = Validator::make($request->all(), $rules, $customMessages);

            if ($validator->fails()) {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
                return back();
            }

            // About modelini bul
            $about = About::findOrFail($id);

            // Toplu veri güncelleme
            $about->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'page_title' => $request->input('page_title'),
                'page_description' => $request->input('page_description'),
                'page_keywords' => $request->input('page_keywords'),
                'slug' => slugify($request->input('name')),
                'name_de' => $request->input('name_de'),
                'description_de' => $request->input('description_de'),
                'page_title_de' => $request->input('page_title_de'),
                'page_description_de' => $request->input('page_description_de'),
                'page_keywords_de' => $request->input('page_keywords_de'),
                'slug_de' => slugify($request->input('name_de')),
                'name_es' => $request->input('name_es'),
                'description_es' => $request->input('description_es'),
                'page_title_es' => $request->input('page_title_es'),
                'page_description_es' => $request->input('page_description_es'),
                'page_keywords_es' => $request->input('page_keywords_es'),
                'slug_es' => slugify($request->input('name_es')),
                'name_fr' => $request->input('name_fr'),
                'description_fr' => $request->input('description_fr'),
                'page_title_fr' => $request->input('page_title_fr'),
                'page_description_fr' => $request->input('page_description_fr'),
                'page_keywords_fr' => $request->input('page_keywords_fr'),
                'slug_fr' => slugify($request->input('name_fr')),
                'name_hu' => $request->input('name_hu'),
                'description_hu' => $request->input('description_hu'),
                'page_title_hu' => $request->input('page_title_hu'),
                'page_description_hu' => $request->input('page_description_hu'),
                'page_keywords_hu' => $request->input('page_keywords_hu'),
                'slug_hu' => slugify($request->input('name_hu')),
                'name_it' => $request->input('name_it'),
                'description_it' => $request->input('description_it'),
                'page_title_it' => $request->input('page_title_it'),
                'page_description_it' => $request->input('page_description_it'),
                'page_keywords_it' => $request->input('page_keywords_it'),
                'slug_it' => slugify($request->input('name_it')),
                'name_sr' => $request->input('name_sr'),
                'description_sr' => $request->input('description_sr'),
                'page_title_sr' => $request->input('page_title_sr'),
                'page_description_sr' => $request->input('page_description_sr'),
                'page_keywords_sr' => $request->input('page_keywords_sr'),
                'slug_sr' => slugify($request->input('name_sr')),
            ]);

            // Başarı mesajı göster ve geri yönlendir
            toast('Hakkımızda sayfası başarıyla güncellendi!', 'success');
            return back();

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
