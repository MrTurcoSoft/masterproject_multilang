<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = [
        'title',
        'btnText',
        'url',
        'isActive',
        'image'
    ];

    public function getTitleAttribute()
    {
        return $this->getLocalizedAttribute('title');
    }
    public function getContentAttribute()
    {
        return $this->getLocalizedAttribute('content');
    }
    public function getContent2Attribute()
    {
        return $this->getLocalizedAttribute('content2');
    }
    public function getBtnTextAttribute()
    {
        return $this->getLocalizedAttribute('btnText');
    }
}

