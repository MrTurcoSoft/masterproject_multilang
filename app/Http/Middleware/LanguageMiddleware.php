<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle($request, Closure $next)
    {
        // `lang` URL parametresinden dili al
        $lang = $request->route('lang') ?? 'en'; // Varsayılan dil: İngilizce
        App::setLocale($lang);

        return $next($request);
    }
}

