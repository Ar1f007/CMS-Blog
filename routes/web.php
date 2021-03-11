<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
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
