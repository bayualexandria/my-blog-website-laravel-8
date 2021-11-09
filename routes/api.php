<?php

use App\Http\Controllers\api\{
    Authentication,
    BlogController,
    CategoryController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Login
Route::post('/login', [Authentication::class, 'login']);

// Register
Route::post('/register', [Authentication::class, 'register']);

Route::middleware('auth:api')->group(function () {

    Route::get('user', function (Request $request) {
        return $request->user();
    });

    // Blog
    Route::get('blog', [BlogController::class, 'get']);
    Route::get('blog/{blog:slug}', [BlogController::class, 'getById']);
    Route::post('blog', [BlogController::class, 'insert']);
    Route::put('blog/{blog:slug}', [BlogController::class, 'update']);
    Route::delete('blog/{blog:slug}', [BlogController::class, 'delete']);

    // Category
    Route::get('/category', [CategoryController::class, 'get']);
    Route::get('/category/{category:slug}', [CategoryController::class, 'getById']);
    Route::post('/category', [CategoryController::class, 'insert']);
    Route::put('/category/{category:slug}', [CategoryController::class, 'update']);
    Route::delete('/category/{category:slug}', [CategoryController::class, 'delete']);
});
