<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function postsIndex(Request $request)
    {
    // if (auth()->user()->is_admin) {
        $search = $request->input('search');
        $selectedAttributes = $request->input('attribute', []);

        $posts = Post::query();

        if ($search && !empty($selectedAttributes)) {
            foreach ($selectedAttributes as $attribute) {
                $posts->orWhere($attribute, 'LIKE', "%{$search}%");
            }
        }
        $posts = $posts->paginate(10);
        return view('admin.posts', [
            "posts" => $posts,
            "search" => $search,
            "selectedAttributes" => $selectedAttributes,
        ]);
    // }
    // return view('home');
}
    public function commentsIndex(Request $request)
    {
    // if (auth()->user()->is_admin) {
        $search = $request->input('search');
        $selectedAttributes = $request->input('attribute', []);

        $comments = Comment::query();

        if ($search && !empty($selectedAttributes)) {
            foreach ($selectedAttributes as $attribute) {
                $comments->orWhere($attribute, 'LIKE', "%{$search}%");
            }
        }
        $comments = $comments->paginate(10);
        return view('admin.comments', [
            "comments" => $comments,
            "search" => $search,
            "selectedAttributes" => $selectedAttributes,
        ]);
    // }
    // return view('home');
}

    public function usersIndex(Request $request)
    {
    // if (auth()->user()->is_admin) {
        $search = $request->input('search');
        $selectedAttributes = $request->input('attribute', []);

        $users = User::query();

        if ($search && !empty($selectedAttributes)) {
            foreach ($selectedAttributes as $attribute) {
                $users->orWhere($attribute, 'LIKE', "%{$search}%");
            }
        }
        $users = $users->paginate(10);
        return view('admin.users', [
            "users" => $users,
            "search" => $search,
            "selectedAttributes" => $selectedAttributes,
        ]);
    // }
    // return view('home');
    }

    public function destroyPost($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route("posts.dashboard");
    }
    public function destroyComment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->route("comments.dashboard");
    }
    public function destroyUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("users.dashboard");
    }
    public function showUser($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return redirect()->route("posts.dashboard");
        }
        return view("admin.userDetails", ["user" => $user]);
    }
}

