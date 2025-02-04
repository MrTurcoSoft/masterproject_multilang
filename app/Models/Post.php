<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
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
        return $this->belongsToMany(Tag::class); // Tag modeline many-to-many ilişki
    }
// Trait'i burada kullanıyorsanız
    use \App\Traits\HasLocaleFields;

    public function testLocale()
    {
        $locale = app()->getLocale();
        $defaultLocale = config('app.locale');

        //dd($locale, $defaultLocale); // Trait call'dan önce bu değerleri kontrol edin.
        dd($locale, config('app.locale'));
    }


}
