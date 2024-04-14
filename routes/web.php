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
use App\Http\Controllers\LikeContoller;
use App\Http\Controllers\CommentContoller;
use App\Http\Controllers\Hashtag;
use App\Http\Controllers\HashtagController;

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
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile/save', [ProfileController::class, 'savePosts'])->name('profile.save');
    Route::get('/profile/{id?}', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{username?}', [UserController::class, 'show'])->name('user.show');
    Route::post('/posts', [PostsController::class, "store"])->name("posts.store");
    Route::post('/follow', [ProfileController::class, 'add'])->name('follow.add');
    Route::delete('/post/{id}', [ProfileController::class, 'DeletePost'])->name('Post.delete');
    Route::get('/post/{id}', [ProfileController::class, 'showModelPost'])->name('Post.show');
    Route::post('/follow', [ProfileController::class, 'add'])->name('follow.add');
    Route::delete('/followers/{id}', [ProfileController::class, 'removeFollower'])->name('follower.delete');
    Route::delete('/following/{id}', [ProfileController::class, 'unfollow'])->name('following.delete');

    Route::get("/followers/{id}/{followerName?}",[ProfileController::class,'showFollowers'])->name('show.followers');
    Route::get("/followings/{id}/{followingName?}",[ProfileController::class,'showFollowings'])->name('show.followings');
    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('/home', [HomeController::class, 'index']);
    Route::get("/followers/{followerName?}",[ProfileController::class,'showFollowers'])->name('show.followers');
    Route::get("/followings/{followingName?}",[ProfileController::class,'showFollowings'])->name('show.followings');
    Route::get("/hashtags",[ProfileController::class,'showHashtags'])->name('show.Hashtags');
    Route::get("/likes",[ProfileController::class,'showLikes'])->name("show.likes");
    Route::post('/profile/edit', [editProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/changephoto', [editProfileController::class, 'changephoto'])->name('profile.changephoto');
    Route::post('/profile/removeimage', [editProfileController::class, 'removeImage'])->name('profile.removeimage');
 // to get hashtag fillter
    Route::get("/hashtags/filter/{id}", [HashtagController::class, 'filter'])->name('hashtag.filter');
    Route::get("/hashtags/{tag}", [HashtagController::class, 'index'])->name('hashtag.index');
    // to get hashtag fillter

    Route::get("/likes", [ProfileController::class, 'showLikes'])->name("show.likes");



    Route::post('/like', [LikeContoller::class, 'store'])->name("like.store");
    Route::delete('/like/destroy/{id}', [LikeContoller::class, 'destroy'])->name("like.destroy");
    Route::post('/comment', [CommentContoller::class, 'store'])->name("comment.store");
    Route::delete('/comment/destroy/{id}', [CommentContoller::class, 'destroy'])->name("comment.destroy");
    Route::get('/post/{id}', [PostsController::class, 'show'])->name("post.show");
    Route::post('/save',[PostsController::class, 'addToFavourite'])->name('save.addtofavourite');
    Route::delete('/save/destroy/{id}', [PostsController::class, 'destroy'])->name("save.destroy");
    Route::post('/commentlike', [CommentContoller::class, 'add'])->name("commentlike.add");
    Route::delete('/commentlike/remove/{id}', [CommentContoller::class, 'remove'])->name("commentlike.remove");
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





require __DIR__ . '/auth.php';
Route::fallback(fn () => 'Route not found');
