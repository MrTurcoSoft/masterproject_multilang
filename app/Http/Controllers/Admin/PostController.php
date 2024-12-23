<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('backend.posts.list', compact('posts'));
    }

    public function create()
    {
        return view('backend.posts.new');
    }

    public function store(Request $request)
    {

        // Diğer verileri al
        $data = $request->except('image', 'tags');
        // Form validation
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'tags' => 'required|string',
            'page_title' => 'required',
            'page_description' => 'required',
            'page_keywords' => 'required',
        ];
        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|dimensions_multiple:1200,500';
        }
        foreach ($languages as $lang) {
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["content_{$lang}"] = 'required';
            $rules["page_title_{$lang}"] = 'required|string|max:255';
            $rules["page_description_{$lang}"] = 'required';
            $rules["page_keywords_{$lang}"] = 'required|string|max:255';
        }

        $customMessages = [
            'required' => ':attribute girişi gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg,png,jpg,gif,svg uzantılı resim dosyası yükleyebilirsiniz! ',
            'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        if ($request->hasFile('image')) {
            if ($request->file('image')->getSize() > 2048 * 1024) { // 2 MB
                \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
                return back()->withErrors(['image' => 'Yüklenen dosya 2 MB\'ı geçemez.']);
            }
            $data['image'] = __webp($request->file('image'), 'blogs', 1200, 500);
        }
        $data['author'] = Auth::user()->name;
        foreach ($languages as $lang) {
            if ($request->has("title_{$lang}")) {
                $data["slug_{$lang}"] = slugify($request->input("title_{$lang}"));
            } else {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', "Blog Yazısı Başlığı ({$lang}) eksik.", 'danger');
                return back();
            }
        }

        $post = Post::create($data);
        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }
            $post->tags()->sync($tagIds);
        }
        toast('Blog Post başarıyla oluşturuldu.', 'success');
        return redirect()->route('posts.index');
    }

    public function edit($id)
    {

        $value = Post::all()->where('id', $id)->firstOrFail();
        return view('backend.posts.edit', compact('value'));
    }

    public function update(Request $request, $id)
    {
        // Diğer verileri al
        $data = $request->except('image', 'tags');
        // Form validation
        $languages = ['de', 'es', 'fr', 'hu', 'it', 'sr'];
        $rules = [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'tags' => 'required|string',
            'page_title' => 'required',
            'page_description' => 'required',
            'page_keywords' => 'required',
        ];
        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg|dimensions_multiple:1200,500';
        }
        foreach ($languages as $lang) {
            $rules["title_{$lang}"] = 'required|string|max:255';
            $rules["content_{$lang}"] = 'required';
            $rules["page_title_{$lang}"] = 'required|string|max:255';
            $rules["page_description_{$lang}"] = 'required';
            $rules["page_keywords_{$lang}"] = 'required|string|max:255';
        }

        $customMessages = [
            'required' => ':attribute girişi gereklidir.',
            'image' => 'Sadece resim dosyası yükleyebilirsiniz!',
            'mimes' => 'Sadece jpeg,png,jpg,gif,svg uzantılı resim dosyası yükleyebilirsiniz! ',
            'max' => 'Yüklediğiniz resmin büyüklüğü 2048 Kb. dan küçük olmalıdır!',
            'dimensions_multiple' => 'Yüklediğiniz resim :minWidth x :minHeight veya bunun katları olmalıdır.'
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        if ($validator->fails()) {
            alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', $validator->errors()->first(), 'danger');
            return back();
        }

        $root = Post::findOrFail($id);

        if ($request->hasFile('image')) {
            // Eski resmi sil
            if ($root->image) {
                __deleteImage($root->image);
            }

            if ($request->file('image')->getSize() > 2048 * 1024) { // 2 MB
                \Log::info('Dosya boyutu: ' . $request->file('image')->getSize());
                return back()->withErrors(['image' => 'Yüklenen dosya 2 MB\'ı geçemez.']);
            }
            $data['image'] = __webp($request->file('image'), 'blogs', 1200, 500);
        }
        $data['author'] = Auth::user()->name;
        foreach ($languages as $lang) {
            if ($request->has("title_{$lang}")) {
                $data["slug_{$lang}"] = slugify($request->input("title_{$lang}"));
            } else {
                alert('<b><i style="color: red" class="bi bi-x-octagon-fill"></i><br>Hata!</b>', "Blog Yazısı Başlığı ({$lang}) eksik.", 'danger');
                return back();
            }
        }

        if ($request->has('tags')) {
            $tags = explode(',', $request->input('tags'));
            $tagIds = [];
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $tagIds[] = $tag->id;
            }
            $root->tags()->sync($tagIds);
        }

        // Modeli güncelle
        $root->update($data);

        // Değişiklikleri kaydet
        $root->save();

        toast('Blog Post Başarıyla Güncellendi', 'success');
        return redirect()->route('posts.index');
    }


    public function destroy(Request $request)
    {
        $id = $request->id;
        $post = Post::find($id);
        if ($post) {
            __deleteFile($post);
            // Kayıt veritabanından silinir
            $post->delete();
            // Başarılı yanıt döndür
            return response()->json(['success' => true, 'message' => 'Blog Yazısı ve dosyası başarıyla silindi.']);
        } else {
            // Katalog bulunamazsa başarısız yanıt döndür
            return response()->json(['success' => false, 'message' => 'Blog Yazısı bulunamadı.']);
        }
    }
}
