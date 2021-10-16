<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// FrontEnd
Route::get('/', function () {
    return view('welcome', [
        'title' => 'Halaman Utama',
        'user' => User::where('email', 'wardanabayu455@gmail.com')->first(),
        'blogs' => Blog::latest()->get()
    ]);
})->name('home');

Route::get('/blogs', function () {

    if (request('category')) {
        $category = Category::firstWhere('slug', request('category'));
        $name = $category->name;
    } else {
        $name = 'Semua';
    }
    return view('blogs', [
        'title' => 'Halaman Blogs',
        'name' => $name,
        'blogs' => Blog::latest()->blogs(request(['search', 'category']))->paginate(5)->withQueryString()
    ]);
})->name('blogs');

Route::get('/blogs/{blog:slug}', function (Blog $blog) {
    return view('detail', [
        'title' => 'Halaman Detail Blog',
        'blog' => $blog
    ]);
})->name('detail');

Route::get('/categories', function () {
    $category = Category::latest();
    if (request('search')) {
        $category->where('name', 'like', '%' . request('search') . '%');
    }
    return view('categories', [
        'title' => 'Halaman Kategori',
        'categories' => $category->get()
    ]);
})->name('categories');

Route::get('/about', function () {
    return view('about', [
        'title' => 'Halaman About',
        'user' => User::where('email', 'wardanabayu455@gmail.com')->first()
    ]);
})->name('about');


// BackEnd
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');
});
Route::post('/login', [AuthenticationController::class, 'attemptLogin'])->name('login');
Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
Route::get('/redirect', [AuthenticationController::class, 'redirectToProvider'])->name('google-redirect');
Route::get('/callback', [AuthenticationController::class, 'handleProviderCallback']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.home', [
            'title' => 'Halaman Dashboard',
            'blogs' => Blog::latest()->get(),
            'categories' => Category::all()
        ]);
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::post('/password', [ProfileController::class, 'password'])->name('password');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::post('/blog', [BlogController::class, 'save'])->name('blog');
    Route::get('/blog/{blog:slug}', [BlogController::class, 'edit'])->name('editBlog');
    Route::put('/blog/{blog:slug}', [BlogController::class, 'update'])->name('editBlog');
    Route::delete('/blog/{blog:slug}', [BlogController::class, 'delete'])->name('deleteBlog');

    Route::get('/category', [CategoryController::class, 'index'])->name(
        'category'
    );
    Route::post('/category', [
        CategoryController::class,
        'save'
    ])->name('category');
    Route::get('/category/{category:slug}', [
        CategoryController::class,
        'edit'
    ])->name('editCategory');
    Route::put('/category/{category:slug}', [
        CategoryController::class,
        'update'
    ])->name('editCategory');
    Route::delete('/category/{category:slug}', [CategoryController::class, 'delete'])->name('deleteCategory');
});
