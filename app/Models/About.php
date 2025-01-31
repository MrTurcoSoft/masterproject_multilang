<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class About extends BaseModel
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    public function getNameAttribute()
    {
        return $this->getLocalizedAttribute('name');
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
