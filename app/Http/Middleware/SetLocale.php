<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        // URL'de bulunan dil kodunu al (route parametresinden)
        $locale = $request->route('locale');

        // Varsayılan dil (config'den al)
        $defaultLocale = config('app.locale');

        // Desteklenen diller
        $supportedLocales = config('app.supported_locales', []);

        // Eğer herhangi bir dil kodu yoksa
        if (!$locale) {
            App::setLocale($defaultLocale); // Varsayılan dili ayarla
            return $next($request); // URL manipüle edilmez
        }

        // Eğer desteklenmeyen bir dil kodu varsa varsayılan dile yönlendirme yap
        if (!in_array($locale, $supportedLocales)) {
            $newUrl = $this->generateUrlWithoutDefault($defaultLocale, $request);
            return redirect($newUrl, 302); // 302 yönlendirme
        }

        // Eğer dil varsayılan dil ise varsayılan dil kodunu kaldırarak yönlendir
        if ($locale === $defaultLocale) {
            $newUrl = $this->generateUrlWithoutDefault($defaultLocale, $request);
            return redirect($newUrl, 302);
        }

        // Eğer geçerli bir dil kodu varsa o dili ayarla
        App::setLocale($locale);
        return $next($request); // Middleware'den geçiş
    }

    /**
     * Varsayılan dil ve gereksiz / işaretini kaldırarak yeni URL oluştur
     *
     * @param string $defaultLocale
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    private function generateUrlWithoutDefault(string $defaultLocale, $request): string
    {
        $baseUrl = $request->getSchemeAndHttpHost(); // Protokol ve domain (ör. https://domain.com)
        $path = $request->getPathInfo(); // URL'nin geri kalanı (/about gibi)

        // Path'ten varsayılan dil kodunu kaldır
        $segments = explode('/', trim($path, '/')); // URL parçalarına ayrılır
        if (isset($segments[0]) && $segments[0] === $defaultLocale) {
            array_shift($segments); // Varsayılan dilliyse bunu kaldır
        }

        // Yeni URL'yi birleştir ve gereksiz / işaretlerini temizle
        return rtrim($baseUrl . '/' . implode('/', $segments), '/');
    }
}
