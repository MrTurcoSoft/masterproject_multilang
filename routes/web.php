<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\DeeplTranslateController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TranslationController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

// Varsayılan dil için (Dil kodu olmadan)
Route::group(['middleware' => 'setlocale'], function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/{about}', [App\Http\Controllers\AboutController::class, 'index'])
    ->where('about', 'about')
    ->name('about');
Route::get('/{catalogue}', [App\Http\Controllers\HomeController::class, 'catalog'])
    ->where('catalogue', 'catalogue')
    ->name('catalogue');
Route::get('/{contact}', [App\Http\Controllers\ContactController::class, 'index'])
    ->where('contact', 'contact')
    ->name('contact');

Route::get('/{category}/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])
    ->where('category', 'category')
    ->name('category');
Route::get('/{product}/{slug}', [App\Http\Controllers\ProductController::class, 'index'])
    ->where('product', 'product')
    ->name('product');

Route::get('/{blog-posts}', [App\Http\Controllers\PostController::class, 'index'])
    ->where('blog-posts', 'blog-posts')
    ->name('blog-posts');
Route::get('/{blog-posts}/{slug}', [App\Http\Controllers\PostController::class, 'show'])
    ->where('blog-posts', 'blog-posts')
    ->name('blog-posts.show');

});

// Diğer diller için rotalar
Route::group(['prefix' => '{locale}', 'middleware' => 'setlocale', 'where' => ['locale' => 'fr|de|it|hu|sr|es']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('localized.home');

    Route::get('/{about}', [App\Http\Controllers\AboutController::class, 'index'])
        ->where('about', 'a-propos|uber-uns|chi-siamo|rolunk|o-nama|sobre-nosotros')
        ->name('localized.about');

    Route::get('/{contact}', [App\Http\Controllers\ContactController::class, 'index'])
        ->where('contact', 'contact|kontakt|contatto|kapcsolat|kontakt|contacto')
        ->name('localized.contact');

    Route::get('/{catalogue}', [App\Http\Controllers\HomeController::class, 'catalog'])
        ->where('catalogue', 'catalogue|katalog|catalogo|katalogus|katalog|catalogo')
        ->name('localized.catalogue');

    Route::get('/{category}/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])
        ->where('category', 'categorie|kategorie|categoria|kategoriak|kategorija|categoria')
        ->name('localized.category');

    Route::get('/{product}/{slug}', [App\Http\Controllers\ProductController::class, 'index'])
        ->where('product', 'produit|produkt|prodotto|termek|proizvod|producto')
        ->name('localized.product');

    Route::get('/{blog-posts}', [App\Http\Controllers\PostController::class, 'index'])
        ->where('blog-posts', 'articles|blog-artikel|articoli|blog-bejegyzesek|blog-objave|entradas-de-blog')
        ->name('localized.blog-posts');

    Route::get('/{blog-posts}/{slug}', [App\Http\Controllers\PostController::class, 'show'])
        ->where('blog-posts', 'articles|blog-artikel|articoli|blog-bejegyzesek|blog-objave|entradas-de-blog')
        ->name('localized.blog-posts.show');
});


Route::get('/sitemap', [SitemapController::class, 'index']);

Route::get('/log-test', function () {
    \Log::error('Bu bir test logudur!');
    return 'Log testi tamamlandı.';
});

Route::get('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->middleware('auth')->name('logout');
