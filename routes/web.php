<?php
// Varsayılan dil (en) rotaları
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\DeeplTranslateController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\SitemapController;



include __DIR__ . '/langRoutes.php';


// Admin rotaları
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');

    // About yönetimi
    Route::get('/about-management', 'App\Http\Controllers\Admin\AboutController@index')->name('about.index');
    Route::post('/about-management/', 'App\Http\Controllers\Admin\AboutController@store')->name('about.store');
    Route::get('/about-management/{id}/{type}', 'App\Http\Controllers\Admin\AboutController@edit')->name('about.edit');
    Route::post('/about-management/{id}', 'App\Http\Controllers\Admin\AboutController@update')->name('about.update');

    // Slider yönetimi
    Route::resource('/slider-management', 'App\Http\Controllers\Admin\SliderController');
    Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('slider.delete');

    // Sertifika yönetimi
    Route::resource('/certificates', 'App\Http\Controllers\Admin\CertificateController');
    Route::post('/certificates/delete', [CertificateController::class, 'destroy'])->name('certificates.delete');

    // Ana sayfa bölümleri
    Route::resource('/homesections', 'App\Http\Controllers\Admin\HomeSectionsController');
    Route::get('/homesections/{id}/{section}', 'App\Http\Controllers\Admin\HomeSectionsController@edit')->name('home-sections.edit');

    // Bölüm sekmeleri
    Route::resource('/sectiontabs', 'App\Http\Controllers\Admin\SectiontabsController');

    // Kategori yönetimi
    Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');
    Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('category.delete');

    // Ürün yönetimi
    Route::resource('/products', 'App\Http\Controllers\Admin\ProductController');
    Route::post('products/delete', [ProductController::class, 'destroy'])->name('products.delete');

    // Ayarlar
    Route::resource('/settings', 'App\Http\Controllers\Admin\SettingsController');
    Route::get('/settings/{id}/{type}', 'App\Http\Controllers\Admin\SettingsController@edit');

    // Katalog yönetimi
    Route::resource('/catalog', 'App\Http\Controllers\Admin\CatalogController');
    Route::post('/catalog/delete', [CatalogController::class, 'destroy'])->name('catalog.delete');

    // Blog yönetimi
    Route::resource('posts', PostController::class);
    Route::post('/posts/delete', [PostController::class, 'destroy'])->name('blog-posts.delete');
});

// Dil değiştirme
Route::get('lang/home', [LangController::class, 'index']);
// routes/web.php

// routes/web.php içinde mevcut change-language route'unu güncelleyin

// routes/web.php

Route::get('change-language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'])) {
        return redirect()->back();
    }

    $previousUrl = url()->previous();
    $segments = parse_url($previousUrl, PHP_URL_PATH);
    $segments = trim($segments, '/');
    $parts = explode('/', $segments);

    // Desteklenen diller
    $supportedLocales = ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'];

    // İlk segment dil kodu mu kontrol et
    $currentLocale = in_array($parts[0], $supportedLocales) ? array_shift($parts) : config('app.fallback_locale', 'en');

    // Statik sayfa çevirileri
    $translations = [
        'about' => [
            'en' => 'about',
            'de' => 'uber-uns',
            'es' => 'sobre-nosotros',
            'fr' => 'a-propos',
            'hu' => 'rolunk',
            'it' => 'chi-siamo',
            'sr' => 'o-nama'
        ],
        'contact' => [
            'en' => 'contact',
            'de' => 'kontakt',
            'es' => 'contacto',
            'fr' => 'contact',
            'hu' => 'kapcsolat',
            'it' => 'contatto',
            'sr' => 'kontakt'
        ],
        'catalogue' => [
            'en' => 'catalogue',
            'de' => 'katalog',
            'es' => 'catalogo',
            'fr' => 'catalogue',
            'hu' => 'katalogus',
            'it' => 'catalogo',
            'sr' => 'katalog'
        ],
        'category' => [
            'en' => 'category',
            'de' => 'kategorie',
            'es' => 'categoria',
            'fr' => 'categorie',
            'hu' => 'kategoria',
            'it' => 'categoria',
            'sr' => 'kategorija'
        ],
        'product' => [
            'en' => 'product',
            'de' => 'produkt',
            'es' => 'producto',
            'fr' => 'produit',
            'hu' => 'termek',
            'it' => 'prodotto',
            'sr' => 'proizvod'
        ],
        'blog-posts' => [
            'en' => 'blog-posts',
            'de' => 'blog-artikel',
            'es' => 'articulos-del-blog',
            'fr' => 'articles-de-blog',
            'hu' => 'blog-cikkek',
            'it' => 'articoli-blog',
            'sr' => 'blog-clanci'
        ],
    ];


    // Sayfanın yeni URL'ini oluştur
    $newPath = [];

    // Varsayılan dil değilse, dil kodunu ekle
    if ($locale !== config('app.fallback_locale', 'en')) {
        $newPath[] = $locale;
    }

    // Diğer segmentleri çevirerek ekle
    foreach ($parts as $part) {
        $translated = false;
        // Statik sayfa çevirilerinde ara
        foreach ($translations as $key => $trans) {
            if (isset($trans[$currentLocale]) && $trans[$currentLocale] === $part) {
                $newPath[] = $trans[$locale];
                $translated = true;
                break;
            }
        }
        // Çeviri bulunamadıysa olduğu gibi ekle
        if (!$translated) {
            $newPath[] = $part;
        }
    }

    // Yeni URL'i oluştur
    $newUrl = url(implode('/', $newPath));

    // Query string varsa ekle
    $query = parse_url($previousUrl, PHP_URL_QUERY);
    if ($query) {
        $newUrl .= '?' . $query;
    }

    // Dili session'a kaydet
    session(['locale' => $locale]);

    return redirect($newUrl);
})->name('changeLanguage');

// API rotaları
Route::post('/api/deepl-translate', [DeeplTranslateController::class, 'translate']);

// Diğer rotalar
Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/route-list', [\App\Http\Controllers\Admin\RouteController::class, 'index'])->name('route.list');

// Cache işlemleri
Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return 'Cache temizlendi!';
});

Route::get('/optimize', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('route:cache');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    Artisan::call('event:cache');
    return 'Cache optimize edildi!';
});

// Authentication rotaları
Auth::routes();
