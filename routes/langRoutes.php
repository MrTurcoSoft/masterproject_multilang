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

##Varsayılan##

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
    Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact');
    Route::get('/catalogue', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue');
    Route::get('/category/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category');
    Route::get('/product/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product');
    Route::get('/blog-posts', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts');
    Route::get('/blog-posts/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show');

    // Almanca (de) rotaları

            Route::get('/de', [App\Http\Controllers\HomeController::class, 'index'])->name('home.de');
            Route::get('/de/uber-uns', [App\Http\Controllers\AboutController::class, 'index'])->name('about.de');
            Route::get('/de/kontakt', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.de');
            Route::get('/de/katalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.de');
            Route::get('/de/kategorie/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.de');
            Route::get('/de/produkt/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.de');
            Route::get('/de/blog-artikel', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.de');
            Route::get('/de/blog-artikel/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.de');


//İspanyolca (es)

            Route::get('/es', [App\Http\Controllers\HomeController::class, 'index'])->name('home.es');
            Route::get('/es/sobre-nosotros', [App\Http\Controllers\AboutController::class, 'index'])->name('about.es');
            Route::get('/es/contacto', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.es');
            Route::get('/es/catalogo', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.es');
            Route::get('/es/categoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.es');
            Route::get('/es/producto/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.es');
            Route::get('/es/articulos-del-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.es');
            Route::get('/es/articulos-del-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.es');


// Fransızca (fr)

            Route::get('/fr', [App\Http\Controllers\HomeController::class, 'index'])->name('home.fr');
            Route::get('/fr/a-propos', [App\Http\Controllers\AboutController::class, 'index'])->name('about.fr');
            Route::get('/fr/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.fr');
            Route::get('/fr/catalogue', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.fr');
            Route::get('/fr/categorie/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.fr');
            Route::get('/fr/produit/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.fr');
            Route::get('/fr/articles-de-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.fr');
            Route::get('/fr/articles-de-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.fr');

// Macarca (hu)

            Route::get('/hu', [App\Http\Controllers\HomeController::class, 'index'])->name('home.hu');
            Route::get('/hu/rolunk', [App\Http\Controllers\AboutController::class, 'index'])->name('about.hu');
            Route::get('/hu/kapcsolat', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.hu');
            Route::get('/hu/katalogus', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.hu');
            Route::get('/hu/kategoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.hu');
            Route::get('/hu/termek/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.hu');
            Route::get('/hu/blog-cikkek', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.hu');
            Route::get('/hu/blog-cikkek/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.hu');

// İtalyanca (it)

            Route::get('/it', [App\Http\Controllers\HomeController::class, 'index'])->name('home.it');
            Route::get('/it/chi-siamo', [App\Http\Controllers\AboutController::class, 'index'])->name('about.it');
            Route::get('/it/contatto', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.it');
            Route::get('/it/catalogo', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.it');
            Route::get('/it/categoria/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.it');
            Route::get('/it/prodotto/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.it');
            Route::get('/it/articoli-blog', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.it');
            Route::get('/it/articoli-blog/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.it');


// Sırpça (sr)
            Route::get('/sr', [App\Http\Controllers\HomeController::class, 'index'])->name('home.sr');
            Route::get('/sr/o-nama', [App\Http\Controllers\AboutController::class, 'index'])->name('about.sr');
            Route::get('/sr/kontakt', [App\Http\Controllers\ContactController::class, 'index'])->name('contact.sr');
            Route::get('/sr/katalog', [App\Http\Controllers\HomeController::class, 'catalog'])->name('catalogue.sr');
            Route::get('/sr/kategorija/{slug}', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.sr');
            Route::get('/sr/proizvod/{slug}', [App\Http\Controllers\ProductController::class, 'index'])->name('product.sr');
            Route::get('/sr/blog-clanci', [App\Http\Controllers\PostController::class, 'index'])->name('blog-posts.sr');
            Route::get('/sr/blog-clanci/{slug}', [App\Http\Controllers\PostController::class, 'show'])->name('blog-posts.show.sr');



