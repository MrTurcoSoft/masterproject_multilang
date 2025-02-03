<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Stichoza\GoogleTranslate\GoogleTranslate;

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
        $cat = Category::where('slug', $slug)->firstOrFail();
        $mainCat = $cat->ust_id ? Category::findOrFail($cat->ust_id) : null;

        // Dile Göre Ürünleri Getir
        $locale = App::getLocale();
        $products = $cat->urunler($locale);

        // Gelen veriyi test edelim
        if ($products->isEmpty()) {
            dd("Ürün bulunamadı. Kategori ID: {$cat->id}, Dil: {$locale}");
        }

        // Dil bazlı özellikleri görünür yap
        $products->each(function ($product) {
            $product->makeVisible(['name', 'title', 'slug', 'description', 'page_title', 'page_description', 'page_keywords']);
        });





        if (\SiteHelpers::ayar('site_theme') == 1) {
            return view("frontend.category", compact('cat', 'products', 'mainCat'));
        } elseif (\SiteHelpers::ayar('site_theme') == 2) {
            return view("porto.category", compact('cat', 'products', 'mainCat'));
        }
    }


}
