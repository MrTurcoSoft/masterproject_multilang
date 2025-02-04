<?php

namespace App\Traits;

trait HasLocaleFields
{
    /**
     * Dil bazlı alanları (örneğin slug, title...) filtreler.
     * Eğer alan dil ile alakalı değilse trait dışında bırakılır.
     */
    public function getLocalizedFields(): array
    {
        // Bu modelde dil bazlı alanları tanımlayın
        return [
            'slug', 'title', 'description', 'content', 'name', 'cat_name', 'page_title', 'page_description', 'page_keywords', 'btnText', 'url', 'settings_key', 'settings_value', 'content2'
        ];
    }

    /**
     * Dil kodu ile bir alanın adını oluşturur.
     */
    public function getLocalizedField(string $field, string $locale): string
    {
        return $locale === app()->getLocale() ? $field : "{$field}_{$locale}";
    }

    /**
     * Localized alanlara göre sorgular.
     */
    public function scopeLocalized($query, ?string $locale = null)
    {
        $locale = $locale ?? app()->getLocale(); // Aktif dil
        $defaultLocale = config('app.locale'); // Varsayılan dil

        // Varsayılan dil ile aktif dil aynıysa özel işlem yapılabilir.
        if ($locale === $defaultLocale) {
            return $query->where(function ($query) use ($defaultLocale) {
                foreach ($this->getLocalizedFields() as $field) {
                    $query->orWhereNotNull($field); // Yalnızca varsayılan dil
                }
            });
        }

        return $query->where(function ($query) use ($locale) {
            foreach ($this->getLocalizedFields() as $field) {
                $localizedField = $this->getLocalizedField($field, $locale);
                $query->orWhereNotNull($localizedField); // Geçerli dilde alan
            }
        });
    }

    /**
     * Bir alanın, belirtilen aktif dile denk gelen değerini döndürür.
     */
    public function getLocalizedValue(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $localizedField = $this->getLocalizedField($field, $locale);

        return $this->{$localizedField} ?? $this->{$field}; // Eğer özel dil bulunmazsa default kullanılır
    }
}
