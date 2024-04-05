<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
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
        
        $posts = Post::with("user")->with("likes")->get();
        $users = User::withCount('posts')->get();
        return view("home")->with('posts', $posts)->with('users', $users);
    }
}
