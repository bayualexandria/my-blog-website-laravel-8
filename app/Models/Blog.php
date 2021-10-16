<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['title', 'body', 'slug', 'category_id', 'user_id', 'cover'];
    protected $with = ['category', 'user'];

    public function scopeBlogs($query, array $search)
    {
        // if (isset($search['search']) ? $search['search'] : false) {
        //     return $query->where('title', 'like', '%' . $search['search'] . '%')
        //         ->orWhere('body', 'like', '%' . $search['search'] . '%');
        // }

        $query->when($search['search'] ?? false, function ($query, $cari) {
            return $query->where('title', 'like', '%' . $cari . '%')
                ->orWhere('body', 'like', '%' . $cari . '%');
        });

        $query->when(
            $search['category'] ?? false,
            fn ($query, $category) =>
            $query->whereHas(
                'category',
                fn ($query) =>
                $query->where('slug', $category)
            )
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
