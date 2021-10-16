<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest();

        if (request('search')) {
            $categories->where('name', 'like', '%' . request('search') . '%')
                ->orWhere('color', 'like', '%' . request('search') . '%');
        }

        return view('backend.category.index', [
            'title' => 'Daftar halaman kategori',
            'categories' => $categories->paginate(1)->withQueryString()
        ]);
    }

    public function save(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:5',
            'icon' => 'required|min:5'
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.min' => 'Nama kategori minimal 5 karakter',
            'icon.required' => 'Nama icon harus diisi',
            'icon.min' => 'Nama icon minimal 5 karakter'
        ]);

        $category->create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $request->icon,
            'color' => $request->color
        ]);

        return redirect()->route('category')->with('success', 'Data kategori berhasil ditambahkan');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', [
            'title' => 'Halaman edit category',
            'category' => $category
        ]);
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'icon' => 'required|min:5'
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.min' => 'Nama kategori minimal 5 karakter',
            'icon.required' => 'Nama icon harus diisi',
            'icon.min' => 'Nama icon minimal 5 karakter'
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $request->icon,
            'color' => $request->color
        ]);

        return redirect()->route('category')->with('success', 'Data kategori berhasil diupdate');
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->route('category')->with('success', 'Data kategori telah dihapus');
    }
}
