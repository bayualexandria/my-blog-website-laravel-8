<?php

namespace App\Http\Controllers;

use App\Models\{Blog, Category};
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Blog $blog, Category $category)
    {
        return view('backend.blog.index', [
            'title' => 'Halaman Blogs',
            'blogs' => $blog->all(),
            'categories' => $category->all()
        ]);
    }

    public function save(Request $request, Blog $blog)
    {


        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:15',
            'cover' => 'image|file|max:1024'
        ], [
            'title.required' => 'Title harus diisi',
            'title.min' => 'Minimal 5 karakter',
            'body.min' => 'Minimal 15 karakter',
            'body.required' => 'Body harus diisi'
        ]);


        $storage = "storage/content/" . Str::of($request->title)->slug('-');

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        if (!file_exists($storage)) {
            mkdir($storage, 755, true);
        }
        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $group);
                $mimetype = $group['mime'];
                $fileNameContent = uniqid();
                $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                $filepath = ("$storage/$fileNameContentRand.$mimetype");
                Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
                $img->setAttribute('class', 'img-fluid img-thumbnail');
            }
        }
 
        $blog->create([
            'title' => request('title'),
            'cover' => ($request->file('cover')) ? $request->file('cover')->store('cover-blog') : '',
            'category_id' => request('category_id'),
            'user_id' => auth()->user()->id,
            'slug' => Str::of(request('title'))->slug('-'),
            'body' => $dom->saveHTML(),
        ]);

        return redirect()->route('blog')->with('success', 'Data blog telah ditambahkan');
    }

    public function edit(Blog $blog, Category $category)
    {
        return view('backend.blog.edit', [
            'title' => 'Halaman edit blog',
            'blog' => $blog,
            'categories' => $category->all()
        ]);
    }

    public function update(Blog  $blog, Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'body' => 'required|min:15'
        ], [
            'title.required' => 'Title harus diisi',
            'title.min' => 'Minimal 5 karakter',
            'body.min' => 'Minimal 15 karakter',
            'body.required' => 'Body harus diisi'
        ]);


        $storage = "storage/content/" . Str::of($blog->slug)->slug('-');
        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($request->body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NOIMPLIED);
        libxml_clear_errors();
        $images = $dom->getElementsByTagName('img');
        if ($blog->update()) {
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                if (preg_match('/data:image/', $src)) {
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $group);
                    $mimetype = $group['mime'];
                    $fileNameContent = uniqid();
                    $fileNameContentRand = substr(md5($fileNameContent), 6, 6) . '_' . time();
                    $filepath = ("$storage/$fileNameContentRand.$mimetype");
                    Image::make($src)->encode($mimetype, 100)->save(public_path($filepath));
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                    $img->setAttribute('class', 'img-fluid img-thumbnail');
                }
            }
        }

        $cover = $blog->cover;
        if ($request->file('cover')) {
            if ($blog->cover) {
                Storage::delete($blog->cover);
            }
            $cover = $request->file('cover')->store('cover-blog');
        }

        $blog->update([
            'title' => request('title'),
            'cover' => $cover,
            'category_id' => request('category_id'),
            'user_id' => auth()->user()->id,
            'slug' => Str::of(request('title'))->slug('-'),
            'body' => $dom->saveHTML(),
        ]);
        return redirect()->route('blog')->with('success', 'Data blog telah diubah');
    }

    public function delete(Blog $blog)
    {
        Storage::delete($blog->cover);
        $blog->delete();
        Storage::deleteDirectory("content/" . $blog->slug);
        return redirect()->route('blog')->with('success', 'Data blog telah dihapus');
    }
}
