<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) {
            $users = User::all();
            $posts = Post::all();
            $comments = Comment::all();
            return view('admin.posts', ["users" => $users, "posts"=>$posts, "comments"=> $comments]);
        }
        return view('home');
    }
}
