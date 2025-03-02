<?php


function getLocalizedColumn($model, $columnBaseName)
{
    $locale = App::getLocale(); // Geçerli dili al

    // Eğer dil İngilizce (varsayılan) ise orijinal sütunu döndür
    if ($locale === 'en') {
        return $model->attributes[$columnBaseName] ?? null; // attributes üzerinden kontrol
    }

    // Lokalize dil kolonunu oluştur ve kontrol et
    $localizedColumn = $columnBaseName . '_' . $locale;

    // Eğer dil ekli bir sütun varsa onu döndür
    if (array_key_exists($localizedColumn, $model->attributes)) {
        return $model->attributes[$localizedColumn];
    }

    // Eğer lokalize sütun yoksa varsayılan sütunu döndür
    return $model->attributes[$columnBaseName] ?? null;
}

function menuUrl(string $routeName, array $parameters = []): string
{
    $locale = app()->getLocale();
    $defaultLocale = config('app.locale');

    // Varsayılan dilde (örneğin "en") locale eklenmez
    if ($locale !== $defaultLocale) {
        $parameters = array_merge(['locale' => $locale], $parameters);
    }

    return route($routeName, $parameters);
}


if (!function_exists('localized_route')) {
    function localized_route($name, $parameters = [])
    {
        $locale = app()->getLocale();
        $defaultLocale = config('app.fallback_locale', 'en');

        if ($locale === $defaultLocale) {
            return route($name, $parameters);
        }

        // Route çevirilerini tanımla
        $routeTranslations = [
            'home' => [
                'name' => 'localized.home',
                'paths' => []
            ],
            'about' => [
                'name' => 'localized.about',
                'paths' => [
                    'sr' => 'o-nama',
                    'fr' => 'a-propos',
                    'de' => 'uber-uns',
                    'it' => 'chi-siamo',
                    'hu' => 'rolunk',
                    'es' => 'acerca-de'
                ]
            ],
            'contact' => [
                'name' => 'localized.contact',
                'paths' => [
                    'sr' => 'kontakt',
                    'fr' => 'contact',
                    'de' => 'kontakt',
                    'it' => 'contatto',
                    'hu' => 'kapcsolat',
                    'es' => 'contacto'
                ]
            ],
            'catalogue' => [
                'name' => 'localized.catalogue',
                'paths' => [
                    'sr' => 'katalog',
                    'fr' => 'catalogue',
                    'de' => 'katalog',
                    'it' => 'catalogo',
                    'hu' => 'katalogus',
                    'es' => 'catalogo'
                ]
            ],
            'category' => [
                'name' => 'localized.category',
                'paths' => [
                    'sr' => 'kategorija',
                    'fr' => 'categorie',
                    'de' => 'kategorie',
                    'it' => 'categoria',
                    'hu' => 'kategoria',
                    'es' => 'categoria'
                ]
            ],
            'product' => [
                'name' => 'localized.product',
                'paths' => [
                    'sr' => 'proizvod',
                    'fr' => 'produit',
                    'de' => 'produkt',
                    'it' => 'prodotto',
                    'hu' => 'termek',
                    'es' => 'producto'
                ]
            ],
            'blog-posts' => [
                'name' => 'localized.blog-posts',
                'paths' => [
                    'sr' => 'blog',
                    'fr' => 'blog',
                    'de' => 'blog',
                    'it' => 'blog',
                    'hu' => 'blog',
                    'es' => 'blog'
                ]
            ],
            'blog-posts.show' => [
                'name' => 'localized.blog-posts.show',
                'paths' => [
                    'sr' => 'blog',
                    'fr' => 'blog',
                    'de' => 'blog',
                    'it' => 'blog',
                    'hu' => 'blog',
                    'es' => 'blog'
                ]
            ]
        ];

        // Route bilgilerini al
        $routeInfo = $routeTranslations[$name] ?? null;
        if (!$routeInfo) {
            return route($name, $parameters);
        }

        // Eğer path tanımlanmışsa ve mevcut dil için bir path varsa, onu kullan
        if (!empty($routeInfo['paths']) && isset($routeInfo['paths'][$locale])) {
            // Eğer slug parametresi varsa, onu koru
            if (isset($parameters['slug'])) {
                $parameters = array_merge(
                    ['locale' => $locale, $routeInfo['paths'][$locale] => $parameters['slug']],
                    array_diff_key($parameters, ['slug' => ''])
                );
            } else {
                $parameters = array_merge(['locale' => $locale], $parameters);
            }
        } else {
            // Path yoksa sadece locale ekle
            $parameters = array_merge(['locale' => $locale], $parameters);
        }

        // Çevirili route adını oluştur
        $localizedName = $routeInfo['name'];

        return route($localizedName, $parameters);
    }
}
