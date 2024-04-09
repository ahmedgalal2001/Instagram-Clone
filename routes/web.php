<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\LikeContoller;
use App\Http\Controllers\CommentContoller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/home', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::post('/posts', [PostsController::class, "store"])->name("posts.store");
    Route::post('/like', [LikeContoller::class, 'store'])->name("like.store");
    Route::delete('/like/destroy/{id}', [LikeContoller::class, 'destroy'])->name("like.destroy");
    Route::post('/comment', [CommentContoller::class, 'store'])->name("comment.store");
    Route::delete('/comment/destroy/{id}', [LikeContoller::class, 'destroy'])->name("comment.destroy");
    Route::get('/post/{id}', [PostsController::class, 'show'])->name("post.show");
    // Route::post('/save',[PostsController::class, 'addToFavourite'])->name('save.addtofavourite');
});

Route::fallback(fn () => 'Route not found');

require __DIR__ . '/auth.php';
