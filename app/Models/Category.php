<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel
{
    use HasFactory;


    protected $guarded = array('_token');


    public function urunler($locale = 'en')
    {
        return $this->belongsToMany(Product::class, 'category_products')->get()->map(function ($urun) use ($locale) {
            if ($locale !== 'en') {
                $urun->name = $urun->{'name_' . $locale};
                $urun->description = $urun->{'description_' . $locale};
                $urun->title = $urun->{'title_' . $locale};
                $urun->slug = $urun->{'slug_' . $locale};
                $urun->page_title = $urun->{'page_title_' . $locale};
                $urun->page_description = $urun->{'page_description_' . $locale};
                $urun->page_keywords = $urun->{'page_keywords_' . $locale};
            }
            return $urun;
        });
    }

    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('cat_name');
    }
    public function getTitleAttribute()
    {
        return $this->getLocalizedAttribute('title');
    }
    public function getDescriptionAttribute()
    {
        return $this->getLocalizedAttribute('description');
    }
    public function getPageTitleAttribute()
    {
        return $this->getLocalizedAttribute('page_title');
    }
    public function getPageDescriptionAttribute()
    {
        return $this->getLocalizedAttribute('page_description');
    }
    public function getPageKeywordsAttribute()
    {
        return $this->getLocalizedAttribute('page_keywords');
    }
    public function getLocalizedSlugAttribute()
    {
        return \App\Helpers\LanguageHelper::getLocalizedColumn($this, 'slug');
    }

    /**
     * Altkategoriler ilişkisi tanımı
     */
    public function altkategoriler()
    {
        return $this->hasMany(Category::class, 'ust_id', 'id');
    }

}
