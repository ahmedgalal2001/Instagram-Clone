<?php

use App\Http\Controllers\editProfileController;
use App\Http\Controllers\followerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostsController;

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
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [editProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/changephoto', [editProfileController::class, 'changephoto'])->name('profile.changephoto');
    Route::post('/profile/removeimage', [editProfileController::class, 'removeImage'])->name('profile.removeimage');
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


Route::get("/emailtest/{email}",[MailController::class,"sendMsg"])->name("mail.sendMsg");

Route::fallback(fn () => 'Route not found');

require __DIR__ . '/auth.php';
