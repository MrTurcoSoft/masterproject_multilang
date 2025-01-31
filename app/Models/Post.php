<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends BaseModel
{
    use HasFactory;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $slug = Str::slug($post->title);
            $originalSlug = $slug;
            $count = 1;

            while (Post::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $post->slug = $slug;
        });
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTitleAttribute()
    {
        return $this->getLocalizedAttribute('title');
    }
    public function getContentAttribute()
    {
        return $this->getLocalizedAttribute('content');
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
