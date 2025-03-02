<?php

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

// Varsayılan dil route'ları (İngilizce)
Route::group(['middleware' => 'web'], function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::get('/catalogue', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue');
Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
Route::get('/blog-posts', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts');
Route::get('/blog-posts/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show');
});

// Diğer diller için route'lar
Route::group(['prefix' => '{locale}', 'middleware' => 'web', 'where' => ['locale' => 'de|es|fr|hu|it|sr']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.de');
    Route::get('/uber-uns', [App\Http\Controllers\AboutController::class, 'index'])->name('about.de');
    Route::get('/kontakt', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.de');
    Route::get('/katalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.de');
    Route::get('/kategorie/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.de');
    Route::get('/produkt/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.de');
    Route::get('/blog-artikel', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.de');
    Route::get('/blog-artikel/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.de');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.es');
    Route::get('/sobre-nosotros', [App\Http\Controllers\AboutController::class, 'index'])->name('about.es');
    Route::get('/contacto', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.es');
    Route::get('/catalogo', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.es');
    Route::get('/categoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.es');
    Route::get('/producto/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.es');
    Route::get('/articulos-del-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.es');
    Route::get('/articulos-del-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.es');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.fr');
    Route::get('/a-propos', [App\Http\Controllers\AboutController::class, 'index'])->name('about.fr');
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.fr');
    Route::get('/catalogue', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.fr');
    Route::get('/categorie/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.fr');
    Route::get('/produit/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.fr');
    Route::get('/articles-de-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.fr');
    Route::get('/articles-de-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.fr');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.hu');
    Route::get('/rolunk', [App\Http\Controllers\AboutController::class, 'index'])->name('about.hu');
    Route::get('/kapcsolat', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.hu');
    Route::get('/katalogus', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.hu');
    Route::get('/kategoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.hu');
    Route::get('/termek/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.hu');
    Route::get('/blog-cikkek', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.hu');
    Route::get('/blog-cikkek/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.hu');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.it');
    Route::get('/chi-siamo', [App\Http\Controllers\AboutController::class, 'index'])->name('about.it');
    Route::get('/contatto', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.it');
    Route::get('/catalogo', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.it');
    Route::get('/categoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.it');
    Route::get('/prodotto/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.it');
    Route::get('/articoli-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.it');
    Route::get('/articoli-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.it');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.sr');
    Route::get('/o-nama', [App\Http\Controllers\AboutController::class, 'index'])->name('about.sr');
    Route::get('/kontakt', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.sr');
    Route::get('/katalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.sr');
    Route::get('/kategorija/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.sr');
    Route::get('/proizvod/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.sr');
    Route::get('/blog-clanci', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.sr');
    Route::get('/blog-clanci/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.sr');

});

