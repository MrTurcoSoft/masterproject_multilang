<?php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->segment(1); // URL'nin ilk segmenti
        $availableLocales = ['fr', 'en', 'de', 'it', 'es', 'hu', 'sr'];

        if (in_array($locale, $availableLocales)) {
            app()->setLocale($locale); // Locale'yi değiştir ama varsayılan dili ALMA
        }

        return $next($request);
    }
}
