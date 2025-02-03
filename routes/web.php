<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\DeeplTranslateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    echo 'Cache temizlendi!';
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
    echo 'Cache optimize edildi!';
});

Route::get('/new-install', function () {
    Artisan::call('storage:link');
    Artisan::call('migrate:refresh');
    Artisan::call('db:seed');

    echo 'Veritaban(lar)ı başarıyla oluşturuldu';
});


Auth::routes();

Route::get('/dashboard', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('dashboard');
//Route::get('/logout',[\App\Http\Controllers\Admin\AdminController::class,'logout'])->name('logout');
Route::get('/about-management', 'App\Http\Controllers\Admin\AboutController@index')->name('about.index');
Route::post('/about-management/', 'App\Http\Controllers\Admin\AboutController@store')->name('about.store');
Route::get('/about-management/{id}/{type}', 'App\Http\Controllers\Admin\AboutController@edit')->name('about.edit');
Route::post('/about-management/{id}', 'App\Http\Controllers\Admin\AboutController@update')->name('about.update');
Route::resource('/slider-management', 'App\Http\Controllers\Admin\SliderController');
Route::post('/slider/delete', [SliderController::class, 'destroy'])->name('slider.delete');
Route::resource('/certificates', 'App\Http\Controllers\Admin\CertificateController');
Route::post('/certificates/delete', [CertificateController::class, 'destroy'])->name('certificates.delete');
Route::resource('/homesections', 'App\Http\Controllers\Admin\HomeSectionsController');
Route::get('/homesections/{id}/{section}', 'App\Http\Controllers\Admin\HomeSectionsController@edit')->name('home-sections.edit');
Route::resource('/sectiontabs', 'App\Http\Controllers\Admin\SectiontabsController');
Route::resource('/categories', 'App\Http\Controllers\Admin\CategoryController');
Route::post('/categories/delete', [CategoryController::class, 'destroy'])->name('category.delete');
Route::resource('/products', 'App\Http\Controllers\Admin\ProductController');
Route::post('products/delete', [ProductController::class, 'destroy'])->name('products.delete');
Route::resource('/settings', 'App\Http\Controllers\Admin\SettingsController');
Route::get('/settings/{id}/{type}', 'App\Http\Controllers\Admin\SettingsController@edit');
Route::resource('/catalog', 'App\Http\Controllers\Admin\CatalogController');
Route::post('/catalog/delete', [CatalogController::class, 'destroy'])->name('catalog.delete');
Route::resource('posts', PostController::class);
Route::post('/posts/delete', [PostController::class, 'destroy'])->name('blog-posts.delete');
Route::post('/api/deepl-translate', [DeeplTranslateController::class, 'translate']);


Route::get('/route-list', [\App\Http\Controllers\Admin\RouteController::class, 'index'])->name('route.list');


Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

/*
|-------------------------------------------------------------------------|
| Multi Languages Web Routes                                              |
|-------------------------------------------------------------------------|
| Bu dosya, uygulamanız için HTTP rotalarını tanımlar. Bu rotalar         |
| Burada web rotalarınızı tanımlarsınız. Bu dosya, uygulamanız için       |
| gelen istekleri yönetir ve yönlendirir. Kodlamada çok dilli destek      |
| ve varsayılan dil işlenmiştir.                                          |
|-------------------------------------------------------------------------|
*/

// Varsayılan dil (en) rotaları:
Route::group([], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Hakkımızda sayfası
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
    // İletişim sayfası
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    //Katalog sayfası
    Route::get('/catalogue', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue');
    // Kategoriler (liste)
    Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    //Product
    Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
    // Blog postları (liste)
    Route::get('/blog_posts', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts');
    // Blog detay (tek bir yazı)
    Route::get('/blog_posts/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show');
});



// Çok dilli rotaları tanımlama (prefix: {locale})
Route::group([
    'prefix' => '{locale}', // Dil kodunu URL'de kullan (örnek: /en, /fr)
    'middleware' => ['setlocale'], // Middleware ile dili otomatik ayarla
    'where' => ['locale' => 'fr|de|it|hu|sr|es'] // Desteklenen diller
], function () {
    // Ana sayfa
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('localized.home');
    // Hakkımızda sayfası
    Route::get('/' . trans('route.about', [], app()->getLocale()), [App\Http\Controllers\AboutController::class, 'index'])->name('localized.about');
    // İletişim sayfası
    Route::get('/' . trans('route.contact', [], app()->getLocale()), [App\Http\Controllers\ContactController::class, 'index'])->name('localized.contact');
    //Katalog sayfası
    Route::get('/' . trans('route.catalogue', [], app()->getLocale()), [App\Http\Controllers\HomeController::class, 'catalog'])->name('localized.catalogue');
    // Kategoriler (liste)
    Route::get('/' . trans('route.category', [], app()->getLocale()). '/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('localized.category');
    //Product
    Route::get('/' . trans('route.product', [], app()->getLocale()). '/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('localized.product');
    // Blog postları (liste)
    Route::get('/' . trans('route.blog_posts', [], app()->getLocale()), [App\Http\Controllers\PostController::class, 'index'])->name('localized.blog-posts');
    // Blog detay (tek bir yazı)
    Route::get('/' . trans('route.blog_posts', [], app()->getLocale()) . '/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('localized.blog-posts.show');
});


Route::get('/sitemap', [SitemapController::class, 'index']);

Route::get('/log-test', function () {
    Log::error('Bu bir test logudur!');
    return 'Log testi tamamlandı.';
});

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');
