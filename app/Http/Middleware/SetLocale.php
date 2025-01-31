<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        // URL'deki ilk segment dil kodudur
        $locale = $request->segment(1);

        // Desteklenen diller
        $availableLocales = ['en', 'fr', 'de', 'it', 'hu', 'sr', 'es'];

        // Eğer segment desteklenen bir dilse, dili ayarla
        if (in_array($locale, $availableLocales)) {
            App::setLocale($locale);
            Session::put('locale', $locale);
        }

        return $next($request);
    }

}
