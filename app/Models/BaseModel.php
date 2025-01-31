<?php

namespace App\Models;

use App\Helpers\LanguageHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use HasFactory;

    public function getLocalizedAttribute($columnBaseName)
    {
        return LanguageHelper::getLocalizedColumn($this, $columnBaseName);
    }

}
