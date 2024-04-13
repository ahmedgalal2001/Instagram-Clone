<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\CommentLikes;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $following = User::with("following")->get();
        // $following->where(Auth::id() == "following_id")->get();
        $comments = CommentLikes::all();
        $posts = Post::with("user")->with("likes")->with('savedposts')->with('user')->get();
        $users = User::withCount('posts')->with('savedposts')->get();
        $loggedInUser = Auth::user();
        $suggestedUsers = User::withCount('posts')->with('savedposts')->take(8)->get();

        // dd($users);
        return view("home")->with('posts', $posts)
                            ->with('users', $users)
                            ->with('comments', $comments)
                            ->with('suggestedUsers', $suggestedUsers)
                            ->with('loggedInUser', $loggedInUser);
    }
}
