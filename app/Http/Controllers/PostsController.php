<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\Like;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Models\Hashtag;
use App\Models\Post;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'commit_message' => 'string|max:500', // Assuming commit_message is a string with a maximum length of 500 characters
                'myfile' => 'required|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480' // Adjusted to accept image and video file formats with increased max size
            ]);
            $response = Cloudinary::upload($request->file('myfile')->getRealPath(), [
                "resource_type" => "auto" // Assuming Cloudinary auto-detects the resource type
            ]);
            $fileExtension = $request->file('myfile')->getClientOriginalExtension();
            $isVideo = in_array($fileExtension, ['mp4', 'mov', 'avi']);
            $post = new Post();
            $post->user_id = Auth::id();
            $post->image_url = $response->getSecurePath(); // Adjusted to get the secure URL
            $post->video = $isVideo ? 1 : 0; // Set video attribute based on the file type
            $post->caption = $validatedData['commit_message'];
            $post->save();
            $commitMessage = $validatedData['commit_message'];
            $pattern = "/#[a-zA-Z0-9_]+/";
            preg_match_all($pattern, $commitMessage, $matches);
            $hashtags = $matches[0];
            $hashtags = array_map(function ($tag) {
                return substr($tag, 1);
            }, $hashtags);
            //  add hashtage and relation
            $hashtags = array_unique($hashtags);
            foreach ($hashtags as $tag) {
                $existingHashtag = Hashtag::where('tag', $tag)->first();
                if (!$existingHashtag) {
                    $existingHashtag = Hashtag::create(['tag' => $tag]);
                }
                $post->hashtags()->attach($existingHashtag->id);
            }
            return response()->json(["msg" => "success"]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $post = Post::with("user")->find($id);
            $like_user = Like::where('post_id', $id)->with('post')->with('user')->first();
            $like = Like::where('post_id', $id)->with('post')->with('user')->get();
            $post_like = Post::with("likes")->find($id);

            $logged_user = Auth::id();


            $comments = $post->comments->map(function ($comment) {
                $timestamp = $comment->created_at;
                $now = Carbon::now();

                $diffInMinutes = $timestamp->diffInMinutes($now);
                $diffInHours = $timestamp->diffInHours($now);

                if ($diffInMinutes < 60) {
                    return $diffInMinutes . ' minutes ago';
                } elseif ($diffInHours < 24) {
                    return $diffInHours . ' hours ago';
                } else {
                    return $timestamp->format('j M Y');
                }
            });



            $posts_time = function ($timestamp) {
                $now = Carbon::now();

                $diffInMinutes = $timestamp->diffInMinutes($now);
                $diffInHours = $timestamp->diffInHours($now);

                if ($diffInMinutes < 60) {
                    return $diffInMinutes . ' minutes ago';
                } elseif ($diffInHours < 24) {
                    return $diffInHours . ' hours ago';
                } else {
                    return $timestamp->format('j M Y');
                }
            };

            $userComment = $post->comments->map(function ($comment) {
                return $comment->user;
            });

            return response()->json([
                'post' => $post,
                'likes' => $like,
                'like_user' => $like_user,
                'comments' => $comments,
                'userComment' => $userComment,
                'allComments' => $post->comments,
                'posts_time' => $posts_time($post->created_at),
                'post_like' => $post_like,
                'logged_user' => $logged_user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    // public function addToFavourite(Request $request)
    // {
    //     $post = Post::find($request->input("id"));

    // }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
