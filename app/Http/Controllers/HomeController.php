<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $following = User::with("following")->get();
        // $following->where(Auth::id() == "following_id")->get();
        
        $posts = Post::with("user")->with("likes")->get();
        // $posts_count = Post::withCount('user')->get();
        // dd($posts_count);
        return view("home")->with('posts', $posts);
    }
}
