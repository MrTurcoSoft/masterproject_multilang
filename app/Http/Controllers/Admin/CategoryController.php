<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SiteHelpers;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('backend.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mevcut kategoriler arasında en yüksek must değerini al
        $maxMust = Category::max('must') ?? 0; // Eğer veri yoksa varsayılan olarak 0 alır
        $categories = Category::all();
        $category = null;
        $value = null;

        return view('backend.category.new', compact('categories', 'maxMust','category','value'));
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
            'cat_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_description' => 'required|string|max:255',
            'page_keywords' => 'required|string|max:255',
            // Resim için validasyon
            'cat_bg' => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions_multiple:1080,1080'
        ];

        // Diğer diller için döngü
        foreach ($languages as $lang) {
            $rules["cat_name_{$lang}"] = 'required|string|max:255';
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["description_{$lang}"] = 'required|string|max:255';
            $rules["page_title_{$lang}"] = 'required|string|max:255';
            $rules["page_description_{$lang}"] = 'required|string|max:255';
            $rules["page_keywords_{$lang}"] = 'required|string|max:255';
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


        $requestData['cat_bg'] = __webp($request->file('cat_bg'), 'categories', 1080, 1080);
        if (!$requestData['cat_bg']) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', 'Resim işlenirken bir sorun oluştu.', 'danger');
            return back();
        }
        foreach ($languages as $lang) {
            if ($request->has("cat_name_{$lang}")) {
                $requestData["slug_{$lang}"] = slugify($request->input("cat_name_{$lang}"));
            } else {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', "Kategori adı ({$lang}) eksik.", 'danger');
                return back();
            }
        }
        try {
            $requestData["slug"] = slugify($request->input("cat_name"));
            Category::create($requestData);
            toast('Kategori başarıyla kaydedildi!', 'success');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', 'Kategori kaydedilirken bir sorun oluştu: ' . $e->getMessage(), 'danger');
            return back();
        }

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
        $categories = Category::all();
        $value = Category::all()->where('id', $id)->firstOrFail();
        return view('backend.category.edit', compact('value', 'categories'));
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
        //dd($request->all());
        // Güncellenen kategoriyi bul
        $category = Category::findOrFail($id);

        // Desteklenen dillerin listesi
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];

        // Validasyon kuralları
        $rules = [
            'cat_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'page_title' => 'required|string|max:255',
            'page_description' => 'required',
            'page_keywords' => 'required|string|max:255',
            'must' => 'required|integer|min:1',
            'cat_bg' => 'nullable|image|mimes:jpeg,png,jpg|max:2048|dimensions_multiple:1080,1080'
        ];

        // Dil bazlı validasyon kuralları
        foreach ($languages as $lang) {
            $rules["cat_name_{$lang}"] = 'required|string|max:255';
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["description_{$lang}"] = 'required';
            $rules["page_title_{$lang}"] = 'required|string|max:255';
            $rules["page_description_{$lang}"] = 'required';
            $rules["page_keywords_{$lang}"] = 'required|string|max:255';
        }

        // Özelleştirilmiş hata mesajları
        $customMessages = [
            'required' => ':attribute alanı gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg, png, jpg uzantılı dosyalar yüklenebilir!',
            'max' => 'Yüklediğiniz dosyanın boyutu 2048 KB\'ı geçemez!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];

        // Validasyonu çalıştır
        $validator = Validator::make($request->all(), $rules, $customMessages);
        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        try {
            // Resim varsa işle
            if ($request->hasFile('cat_bg')) {
                // Eski resmi sil
              $delete =  __deleteImage($category->cat_bg);

               $cat_bg = __webp($request->file('cat_bg'), 'categories', 1080, 1080);
            }

            // Ana dilde bilgileri güncelle
            $category->update([
                'cat_name' => $request->input('cat_name'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'page_title' => $request->input('page_title'),
                'page_description' => $request->input('page_description'),
                'page_keywords' => $request->input('page_keywords'),
                'cat_bg' => $cat_bg ?? $category->cat_bg,
                'must' => $request->input('must'),
                'isActive' => $request->input('isActive'),
                'slug' => slugify($request->input('cat_name')),
            ]);

            // Dil bazlı alanları güncelle
            foreach ($languages as $lang) {
                $category->update([
                    "cat_name_{$lang}" => $request->input("cat_name_{$lang}"),
                    "title_{$lang}" => $request->input("title_{$lang}"),
                    "description_{$lang}" => $request->input("description_{$lang}"),
                    "page_title_{$lang}" => $request->input("page_title_{$lang}"),
                    "page_description_{$lang}" => $request->input("page_description_{$lang}"),
                    "page_keywords_{$lang}" => $request->input("page_keywords_{$lang}"),
                    "slug_{$lang}" => slugify($request->input("cat_name_{$lang}")),
                ]);
            }

            toast('Kategori başarıyla güncellendi!', 'success');
            return redirect()->route('categories.index');
        } catch (\Exception $e) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', 'Kategori güncellenirken bir sorun oluştu: ' . $e->getMessage(), 'danger');
            return back();
        }
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
        $category = Category::find($id);
        if ($category) {
            __deleteImage($category->cat_bg);
            $category->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
