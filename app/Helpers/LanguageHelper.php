<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;

class LanguageHelper
{
    public static function getLocalizedColumn($model, $columnBaseName)
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
}
