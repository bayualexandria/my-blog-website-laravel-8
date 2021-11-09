<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function get(Category $category)
    {
        return response()->json([
            'data' => $category->all()
        ], 200);
    }

    public function getById(Category $category)
    {
        return response()->json([
            'data' => $category
        ], 200);
    }

    public function insert(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|min:5',
            'icon' => 'required|min:5',
            'color' => 'required'
        ], [
            'name.required' => 'Nama kategori harus diisi',
            'name.min' => 'Nama kategori minimal 5 karakter',
            'icon.required' => 'Nama icon harus diisi',
            'icon.min' => 'Nama icon minimal 5 karakter',
            'color.required' => 'Nama warna harus diisi'
        ]);
        $category->create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'icon' => $request->icon,
            'color' => $request->color
        ]);
        return response()->json([
            'data' => $category,
            'message' => 'Data has been created'
        ], 200);
    }

    public function update(Category $category, Request $request)
    {
        $category->update([
            'name' => $request->name
                ? $request->name
                : $category->name,
            'slug' => $request->name
                ? Str::of($request->name)->slug('-')
                : $category->slug,
            'icon' => $request->icon
                ? $request->icon
                : $category->icon,
            'color' => $request->color
                ? $request->color
                : $category->color,
        ]);
        return response()->json([
            'data' => $category,
            'message' => 'Data has been updated'
        ], 200);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Data category has deleted',
            'status' => 200
        ], 200);
    }
}
