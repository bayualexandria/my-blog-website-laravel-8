<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function get(Blog $blog)
    {
        return response()->json([
            'data' => $blog->all(),
            'message' => 'All data blogs',
            200
        ], 200);
    }

    public function getById(Blog $blog)
    {
        return response()->json([
            'data' => $blog,
            'message' => 'Find data blog',
            200
        ], 200);
    }

    public function insert(Request $request, Blog $blog)
    {
        $request->validate(
            [
                'title' => 'required|unique:blogs',
                'body' => 'required',
                'category_id' => 'required',
                'user_id' => 'required'
            ],
            [
                'title.required' => 'Title harus diisi',
                'title.unique' => 'Title yang anda masukkan sudah terdaftar',
                'body.required' => 'Body harus diisi',
                'category_id.required' => 'Category id harus diisi',
                'user_id.required' => 'User id harus diisi',
            ]
        );

        $blog->create([

            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'slug' => Str::of($request->title)->slug('-')

        ]);

        return response()->json([

            'data' => $blog,
            'message' => 'Data has been created'

        ], 200);
    }

    public function update(Blog $blog, Request $request)
    {
        $blog->update([
            'title' => $request->title
                ? $request->title
                : $blog->title,
            'body' => $request->body
                ? $request->body
                : $blog->body,
            'category_id' => $request->category_id
                ? $request->category_id
                : $blog->category_id,
            'user_id' => $request->user_id
                ? $request->user_id
                : $blog->user_id,
            'slug' => $request->title
                ? Str::of($request->title)->slug('-')
                : $blog->slug
        ]);

        return response()->json([

            'data' => $blog,
            'message' => 'Data has been updated'

        ], 200);
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        return response()->json([
            'message' => 'Data blog has deleted',
            'status' => 200
        ], 200);
    }
}
