<?php
// app/Http/Middleware/SetLocale.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // URL'den dil parametresini al
        $locale = $request->segment(1);

        // Desteklenen diller
        $supportedLocales = ['en', 'de', 'es', 'fr', 'hu', 'it', 'sr'];

        // Eğer URL'de geçerli bir dil kodu varsa onu kullan
        if (in_array($locale, $supportedLocales)) {
            app()->setLocale($locale);
            session(['locale' => $locale]);
        }
        // Session'da kayıtlı dil varsa onu kullan
        else if (session()->has('locale') && in_array(session('locale'), $supportedLocales)) {
            app()->setLocale(session('locale'));
        }
        // Yoksa varsayılan dili kullan
        else {
            app()->setLocale(config('app.fallback_locale', 'en'));
        }

        // PHP locale'ini ayarla
        $phpLocale = [
            'en' => 'en_US',
            'de' => 'de_DE',
            'es' => 'es_ES',
            'fr' => 'fr_FR',
            'hu' => 'hu_HU',
            'it' => 'it_IT',
            'sr' => 'sr_RS'
        ];

        $currentLocale = app()->getLocale();
        if (isset($phpLocale[$currentLocale])) {
            setlocale(LC_TIME, $phpLocale[$currentLocale].'.utf8');
        }

        return $next($request);
    }
}
