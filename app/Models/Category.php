<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;


    protected $guarded = array('_token');



    public function urunler($locale)
    {
        $query = $this->belongsToMany(Product::class, 'category_products');

        $products = $query->get();

        if ($products->isEmpty()) {
            dd("Hiç ürün bulunamadı.");
        }

        return $products->map(function ($urun) use ($locale) {
            // Varsayılan dil kontrolü
            $isDefaultLanguage = $locale === 'en'; // Varsayılan dil 'tr' ise

            // Fallback mekanizması
            $urun->name = $isDefaultLanguage ? $urun->name : ($urun->{'name_' . $locale} ?? $urun->name);
            $urun->title = $isDefaultLanguage ? $urun->title : ($urun->{'title_' . $locale} ?? $urun->title);
            $urun->slug = $isDefaultLanguage ? $urun->slug : ($urun->{'slug_' . $locale} ?? $urun->slug);
            $urun->description = $isDefaultLanguage ? $urun->description : ($urun->{'description_' . $locale} ?? $urun->description);
            $urun->page_title = $isDefaultLanguage ? $urun->page_title : ($urun->{'page_title_' . $locale} ?? $urun->page_title);
            $urun->page_description = $isDefaultLanguage ? $urun->page_description : ($urun->{'page_description_' . $locale} ?? $urun->page_description);
            $urun->page_keywords = $isDefaultLanguage ? $urun->page_keywords : ($urun->{'page_keywords_' . $locale} ?? $urun->page_keywords);

            return $urun;
        });
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale(); // Geçerli dil
        $isDefaultLanguage = $locale === 'en'; // Varsayılan dil 'tr' ise

        // Varsayılan dilde dil kodu eklemeden, diğer dillerde dil kodunu ekleyerek döndür
        return $isDefaultLanguage ? $this->attributes['name'] : ($this->{'name_' . $locale} ?? $this->attributes['name']);
    }
    /**
     * Altkategoriler ilişkisi tanımı
     */
    public function altkategoriler()
    {
        return $this->hasMany(Category::class, 'ust_id', 'id');
    }

}
