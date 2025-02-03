<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = array('_token');


    protected $appends = ['name', 'title', 'slug', 'description', 'page_title', 'page_description', 'page_keywords'];

    public function kategoriler()
    {
        return $this->belongsToMany('App\Models\Category','category_products');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function detay()
    {
        return $this->hasOne('App\Models\ProductDetail')->withDefault();
    }

    public function getNameAttribute($value)
    {
        $locale = app()->getLocale(); // Geçerli dil
        return $this->{'name_' . $locale} ?? $value; // Dil sütunu yoksa varsayılanı döndür
    }

    public function getTitleAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'title_' . $locale} ?? $value;
    }

    public function getSlugAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'slug_' . $locale} ?? $value;
    }

    public function getDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'description_' . $locale} ?? $value;
    }

    public function getPageTitleAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'page_title_' . $locale} ?? $value;
    }

    public function getPageDescriptionAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'page_description_' . $locale} ?? $value;
    }

    public function getPageKeywordsAttribute($value)
    {
        $locale = app()->getLocale();
        return $this->{'page_keywords_' . $locale} ?? $value;
    }
}
