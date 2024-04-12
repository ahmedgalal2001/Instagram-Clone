<?php

use App\Http\Controllers\editProfileController;
use App\Http\Controllers\followerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AdminController;

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


Route::middleware('auth')->group(function () {
    Route::middleware('user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/save/{id?}', [ProfileController::class, 'savePosts'])->name('profile.save');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{username}', [UserController::class, 'show'])->name('user.show');
    Route::post('/posts', [PostsController::class, "store"])->name("posts.store");
    Route::post('/follow', [ProfileController::class, 'add'])->name('follow.add');
    Route::get('/post/{id}', [ProfileController::class, 'showModelPost'])->name('Post.show');
    Route::delete('/followers/{id}', [ProfileController::class, 'removeFollower'])->name('follower.delete');
    Route::delete('/following/{id}', [ProfileController::class, 'unfollow'])->name('following.delete');
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home', [HomeController::class, 'index']);
    });
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard/posts', [AdminController::class, 'postsIndex'])->name('posts.dashboard');
        Route::get('/dashboard/comments', [AdminController::class, 'commentsIndex'])->name('comments.dashboard');
        Route::get('/dashboard/users', [AdminController::class, 'usersIndex'])->name('users.dashboard');
        Route::delete("/dashboard/posts/{post}", [AdminController::class, "destroyPost"])->name("posts.destroy");
        Route::delete("/dashboard/comments/{post}", [AdminController::class, "destroyComment"])->name("comments.destroy");
        Route::delete("/dashboard/users/{post}", [AdminController::class, "destroyUser"])->name("users.destroy");
        Route::get("/dashboard/users/{user}", [AdminController::class, "showUser"])->name("users.showUser");
    });
    
    

});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard/posts', [AdminController::class, 'postsIndex'])->name('posts.dashboard');
    Route::get('/dashboard/comments', [AdminController::class, 'commentsIndex'])->name('comments.dashboard');
    Route::get('/dashboard/users', [AdminController::class, 'usersIndex'])->name('users.dashboard');
    Route::delete("/dashboard/posts/{post}", [AdminController::class, "destroyPost"])->name("posts.destroy");
    Route::delete("/dashboard/comments/{post}", [AdminController::class, "destroyComment"])->name("comments.destroy");
    Route::delete("/dashboard/users/{post}", [AdminController::class, "destroyUser"])->name("users.destroy");
    Route::get("/dashboard/users/{user}", [AdminController::class, "showUser"])->name("users.showUser");
});



Route::get("/emailtest/{email}",[MailController::class,"sendMsg"])->name("mail.sendMsg");

Route::fallback(fn () => 'Route not found');
