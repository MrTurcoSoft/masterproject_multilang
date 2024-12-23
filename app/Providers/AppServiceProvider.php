<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('active', function ($route) {
            return "<?php echo Route::currentRouteNamed($route) ? 'active' : ''; ?>";
        });
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);

        Validator::extend('dimensions_multiple', function ($attribute, $value, $parameters, $validator) {
            if ($value->isValid()) {
                // Resim boyutlarını al
                $image = getimagesize($value->getRealPath());
                $width = $image[0];  // Genişlik
                $height = $image[1]; // Yükseklik

                // Minimum boyutlar (örnek: 1920x1280)
                $minWidth = $parameters[0];
                $minHeight = $parameters[1];

                // Boyutların kat olup olmadığını kontrol et
                return ($width % $minWidth === 0 && $height % $minHeight === 0);
            }

            return false;
        });

        Validator::replacer('dimensions_multiple', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':minWidth', ':minHeight'], $parameters, $message);
        });
    }
}
