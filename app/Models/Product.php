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

    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
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
    public function getSlugAttribute()
    {
        return $this->getLocalizedAttribute('slug');
    }
}
