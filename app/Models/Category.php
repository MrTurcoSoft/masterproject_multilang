<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;


    protected $guarded = array('_token');


    public function urunler()
    {
        return $this->belongsToMany(Product::class, 'category_products'); // Pivot tabloyu belirtin
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
