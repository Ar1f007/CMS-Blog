<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BlogPostController;

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


Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('blog/posts/{post}', [BlogPostController::class, 'displayPost'])->name('blog.show');
Route::get('blog/categories/{category}', [BlogPostController::class, 'categoryPostIndex'])->name('blog.category');
Route::get('blog/tags/{tag}', [BlogPostController::class, 'TagPostIndex'])->name('blog.tag');


Route::middleware(['auth'])->group(function () 
{
    Route::view('profile', 'users.my-profile')->name('profile');
    Route::put('profile', [UsersController::class, 'update'])->name('profile.update');
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::resource('categories', CategoriesController::class);
    Route::resource('tags', TagsController::class);
    Route::resource('posts', PostsController::class);
    Route::get('trashed-posts', [PostsController::class, 'trashed'])->name('trashed-posts.index');
    Route::put('restore-post/{post}', [PostsController::class, 'restore'])->name('restore-posts');
});


Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::post('users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
});

require __DIR__.'/auth.php';
