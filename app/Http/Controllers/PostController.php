<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
       // dd(trans('route.blog_posts', [], app()->getLocale()));
        $post = \App\Models\Post::find(22);
        $post->testLocale();

        $posts = Post::paginate(12);
        return view('porto.posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        // Görüntüleme sayısını arttır
        $post->increment('views');
        $date = $post->created_at->format('d F y');
        $date = explode(' ', $date);
        $day = $date[0];
        $month = $date[1];
        $year = $date[2];

        return view('porto.posts.show', compact('post', 'day', 'month', 'year'));
    }
}
