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


}
