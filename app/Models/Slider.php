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


}

