<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use SiteHelpers;

class ProductController extends Controller
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
        $products = Product::all();
        return view('backend.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mevcut kategoriler arasında en yüksek must değerini al
        $maxMust = Product::max('must') ?? 0; // Eğer veri yoksa varsayılan olarak 0 alır
        $categories = Category::all();
        return view('backend.product.new',compact('categories','maxMust'));
    }

    private function validateProductRequest(Request $request, $withImage = true)
    {
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
        $rules = [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'page_title' => 'required',
            'page_description' => 'required',
            'page_keywords' => 'required',
            'must' => 'required|integer',
        ];

        if ($withImage) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg|dimensions_multiple:800,600';
        }

        foreach ($languages as $lang) {
            $rules["name_{$lang}"] = 'required|string|max:255';
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["description_{$lang}"] = 'required';
            $rules["page_title_{$lang}"] = 'required|string|max:255';
            $rules["page_description_{$lang}"] = 'required';
            $rules["page_keywords_{$lang}"] = 'required|string|max:255';
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->file('image')->getSize() > 2048 * 1024) { // 2 MB
            \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
            return back()->withErrors(['image' => 'Yüklenen dosya 2 MB\'ı geçemez.']);
        }
        // Validasyonu çalıştır
        $validator = $this->validateProductRequest($request, true);
        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        // Veriyi hazırlama
        $data = $request->all();
        $data['image'] = __webp($request->file('image'), 'products', 800, 600);
        $data['slug'] = slugify($data['name'] . '-' . $data['title']);

        foreach (['de', 'es', 'fr', 'hu', 'it', 'sr'] as $lang) {
            $data["slug_{$lang}"] = slugify($request->input("name_{$lang}") . '-' . $request->input("title_{$lang}"));
        }

        // Ana ürün kaydı
        $product = Product::create($data);

        // Detay verisini ekleme
        $product->detay()->create($request->only('volume', 'boxsize', 'qtyBox', 'BoxNetW', 'BoxGrossW', 'BoxOnPallet', 'hsCode', 'barcode'));

        // Kategorileri ekleme
        if ($request->categories) {
            $product->kategoriler()->sync($request->categories);
        }

        toast('Ürün Başarıyla Eklendi', 'success');
        return redirect()->route('products.index');
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
    public function edit($id)
    {
        $value = Product::with('kategoriler')->findOrFail($id); // İlişkili kategoriler yüklenir
        $product_cat = $value->kategoriler()->pluck('category_id')->all();
        $categories = Category::all();
        return view('backend.product.edit', compact('value','categories','product_cat'));
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

        $product = Product::findOrFail($id);

        // Validasyonu çalıştır (resim yüklenmişse kontrol et)
        $validator = $this->validateProductRequest($request, $request->hasFile('image'));
        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        // Veriyi hazırlama
        $data = $request->all();
        if ($request->hasFile('image')) {
            \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
            __deleteImage($product->image);
            $data['image'] = __webp($request->file('image'), 'products', 800, 600);
        }

        $data['slug'] = slugify($data['name'] . '-' . $data['title']);
        foreach (['de', 'es', 'fr', 'hu', 'it', 'sr'] as $lang) {
            $data["slug_{$lang}"] = slugify($request->input("name_{$lang}") . '-' . $request->input("title_{$lang}"));
        }

        // Ana ürünü güncelle
        $product->update($data);

        // Detay verisini güncelle
        $product->detay()->update($request->only('volume', 'boxsize', 'qtyBox', 'BoxNetW', 'BoxGrossW', 'BoxOnPallet', 'hsCode', 'barcode'));

        // Kategorileri güncelle
        $product->kategoriler()->sync($request->categories ?? []);

        toast('Ürün Başarıyla Güncellendi', 'success');
        return redirect()->route('products.index');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        if ($product) {
            __deleteImage($product->image);
            $product->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
