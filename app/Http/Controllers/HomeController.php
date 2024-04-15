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
        $comments = CommentLikes::all();
        $posts = Post::with("user")->with("likes")->with('savedposts')->with('user')->get();
        $users = User::withCount('posts')->with('savedposts')->get();
        $loggedInUser = Auth::user();
        $suggestedUsers = User::withCount('posts')->with('savedposts')->take(8)->get();

        $threePosts = User::with('posts')->take(3)->get();

        //dd($threePosts);
            

        $usersWithFollowersCount = User::withCount('followers')->get();
        $usersWithFollowingCount = User::withCount('following')->get();
        //dd($usersWithFollowingCount);
        // dd($usersWithFollowersCount);
        $userWithFollowings = User::with('following')->find(Auth::id());
        $followingsId = $userWithFollowings->following->pluck('id');
        
        $followingsId[] = Auth::id();

        $followingPosts = Post::whereIn('user_id' , $followingsId)->latest()->get();

        // dd($users);
        return view("home")->with('posts', $posts)
                            ->with('users', $users)
                            ->with('comments', $comments)
                            ->with('suggestedUsers', $suggestedUsers)
                            ->with('loggedInUser', $loggedInUser)
                            ->with('followingsIds', $followingsId)
                            ->with('followingPosts' , $followingPosts)
                            ->with('usersWithFollowersCount' , $usersWithFollowersCount)
                            ->with('usersWithFollowingCount' , $usersWithFollowingCount)
                            ->with('threePosts' , $threePosts);
    }
}
