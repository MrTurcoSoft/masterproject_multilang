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



// Desteklenen diğer diller için prefix kullanarak rotalar
Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale'], function () {
    Route::get('/about', [AboutController::class, 'index'])->name('about.index.locale');
});

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
Route::get('change-language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'])) {
        // Mevcut URL'yi al
        $previousUrl = url()->previous();

        // Mevcut dil dizinini al (örneğin: 'hu')
        $segments = explode('/', parse_url($previousUrl, PHP_URL_PATH));

        // İlk segmenti (dil kodu) yeni dil kodu ile değiştir
        if (in_array($segments[1], ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'])) {
            $segments[1] = $locale;
        } else {
            // Eğer dil kodu yoksa, başa yeni dil kodunu ekle
            array_splice($segments, 1, 0, $locale);
        }

        // Yeni URL'yi oluştur
        $newUrl = url(implode('/', $segments));

        // Dili session'a kaydet
        session(['locale' => $locale]);
        app()->setLocale($locale);

        return redirect($newUrl);
    }
    return redirect()->back();
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
