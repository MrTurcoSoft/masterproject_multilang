<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionTab extends BaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = array('_token');

    public function getTitleAttribute()
    {
        return $this->getLocalizedAttribute('title');
    }
    public function getDescriptionAttribute()
    {
        return $this->getLocalizedAttribute('description');
    }
    public function getBtnTextAttribute()
    {
        return $this->getLocalizedAttribute('btnText');
    }
    public function getUrlAttribute()
    {
        return $this->getLocalizedAttribute('url');
    }
}
