<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Ana ve alt kategoriler
        View::composer('*', function ($view) { // Bu örnekte tüm Blade dosyalarına uygulanır.
            $view->with('_categories', Category::with('altkategoriler')
                ->whereNull('ust_id') // Sadece ana kategoriler
                ->where('isActive', 1) // Sadece aktif kategoriler
                ->orderBy('must') // Sıralama
                ->get());
        });

    }
}
