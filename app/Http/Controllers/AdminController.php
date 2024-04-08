<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function postsIndex()
    {
        if (!auth()->user()->is_admin) {
            $posts = Post::all();
            // $users = User::all();
            // $comments = Comment::all();
            return view('admin.posts', ["posts"=>$posts]);
        }
        return view('home');
    }
    public function commentsIndex()
    {
        if (!auth()->user()->is_admin) {
            $comments = Comment::all();
            return view('admin.comments', ["comments"=> $comments]);
        }
        return view('home');
    }
}
