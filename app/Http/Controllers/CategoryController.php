<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\App;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug)
    {
        // Kategori ve üst kategoriyi getir
        $cat = Category::where('slug', $slug)->firstOrFail();
        $mainCat = $cat->ust_id ? Category::find($cat->ust_id) : null;

        // Dile göre ürünleri al
        $locale = App::getLocale();

        // Kategoriye ait tüm ürünleri ilişki üzerinden getir
        $products = $cat->urunler->map(function ($urun) use ($locale) {
            $isDefaultLanguage = $locale === 'en'; // Varsayılan dil 'tr' ise
            // Dil bazlı alanları ayarla
            $urun->name = $isDefaultLanguage ? $urun->name : ($urun->{'name_' . $locale} ?? $urun->name);
            $urun->title = $isDefaultLanguage ? $urun->title : ($urun->{'title_' . $locale} ?? $urun->title);
            $urun->slug = $isDefaultLanguage ? $urun->slug : ($urun->{'slug_' . $locale} ?? $urun->slug);
            $urun->description = $isDefaultLanguage ? $urun->description : ($urun->{'description_' . $locale} ?? $urun->description);
            $urun->page_title = $isDefaultLanguage ? $urun->page_title : ($urun->{'page_title_' . $locale} ?? $urun->page_title);
            $urun->page_description = $isDefaultLanguage ? $urun->page_description : ($urun->{'page_description_' . $locale} ?? $urun->page_description);
            $urun->page_keywords = $isDefaultLanguage ? $urun->page_keywords : ($urun->{'page_keywords_' . $locale} ?? $urun->page_keywords);

            return $urun;
        });

        // Eğer ürün bulunamıyorsa bir hata verebilirsiniz
        if ($products->isEmpty()) {
            dd("Ürün bulunamadı. Kategori ID: {$cat->id}, Dil: {$locale}");
        }

        // Site temasına göre uygun görünümü döndür
        if (\SiteHelpers::ayar('site_theme') == 1) {
            return view("frontend.category", compact('cat', 'products', 'mainCat'));
        } elseif (\SiteHelpers::ayar('site_theme') == 2) {
            return view("porto.category", compact('cat', 'products', 'mainCat'));
        }
    }
}
