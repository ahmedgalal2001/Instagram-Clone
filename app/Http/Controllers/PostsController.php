<?php

namespace App\Http\Controllers;

use App\Models\SaveUserPost;
use Illuminate\Support\Carbon;
use App\Models\Like;
use App\Models\Comment;
use App\Models\CommentLikes;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Controller;
use App\Models\Post;
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
        $validatedData = $request->validate([
            'commit_message' => 'string|max:500', // Assuming commit_message is a string with a maximum length of 255 characters
            'myfile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $image = $request->file('myfile');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Generate a unique image name
        $image->move(public_path('images/posts'), $imageName);
        $post = new Post();
        $post->user_id = Auth::id();
        $post->image_url = $imageName;
        $post->caption = $validatedData['commit_message'];
        $post->save();
        return redirect()->action([HomeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{

            $post = Post::with("user")->find($id);
            $like_user = Like::where('post_id', $id)->with('post')->with('user')->first();
            $like = Like::where('post_id', $id)->with('post')->with('user')->get();
            $post_like = Post::with("likes")->find($id);
            $post_comment_id = Post::with("comments")->find($id);
            $saved_posts = Post::with("savedposts")->find($id);

            $logged_user = Auth::id();

            $allCommentLikes = CommentLikes::all();
            $CommentLikeUser = CommentLikes::where('user_id', Auth::id())->get();
            $all_likes = Like::where('post_id', $id)->count();

            $allCommentLikesUsers = Comment::with('commentlikes.user')->get();

            $final = $allCommentLikesUsers->map(function ($comment) {
                return [
                    'comment_id' => $comment->id,
                    'likes' => $comment->commentlikes->map(function ($like) {
                        return [
                            'user' => $like->user,
                        ];
                    }),
                ];
            });



            

            
            $comments = $post->comments->map(function($comment) {
                $timestamp = $comment->created_at;
                $now = Carbon::now();
                
                $diffInMinutes = $timestamp->diffInMinutes($now);
                $diffInHours = $timestamp->diffInHours($now);
            
                if ($diffInMinutes < 60) 
                {
                    return $diffInMinutes . ' minutes ago';
                } 
                elseif ($diffInHours < 24) 
                {
                    return $diffInHours . ' hours ago';
                } else {
                    return $timestamp->format('j M Y'); 
                }
            });



            $posts_time = function($timestamp) {
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

            $userComment = $post->comments->map(function($comment) {
                return $comment->user;
            });
            
            return response()->json([
                'post' => $post,
                'likes' => $like,
                'like_user' => $like_user,
                'comments'=> $comments,
                'userComment' => $userComment,
                'allComments'=> $post->comments,
                'posts_time' => $posts_time($post->created_at),
                'post_like'=> $post_like,
                'logged_user'=> $logged_user,
                'allCommentLikes' => $allCommentLikes,
                'saved_posts' => $saved_posts,
                'post_comment_id'=> $post_comment_id,
                'CommentLikeUser' => $CommentLikeUser,
                'allCommentLikesUsers' => $allCommentLikesUsers,
                'final' => $final,
                'all_likes_count' => $all_likes,
            ]);
        } catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage(),
            ]);
        }
    }
    
    public function addToFavourite(Request $request)
    {
        try{
            $id_post = $request->input("id");
            $id_user = Auth::id();
            $book_mark = new SaveUserPost();
            $book_mark->user_id = $id_user;
            $book_mark->post_id = $id_post;
            $book_mark->save();

            return response()->json([
                'message' => 'Post stored successfully',
            ]);
        } catch(\Exception $e){
            return response()->json([
                'error'=> $e->getMessage(),
            ]);
        }

    }
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
        $user_id = Auth::id();
        $savedPost = SaveUserPost::where('post_id', $id)->where('user_id', $user_id)->delete();
        return response()->json([
            "message" => "Deleted successfully",
            'savedPost'=> $savedPost,
        ]);
    }
}
