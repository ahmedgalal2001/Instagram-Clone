<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\CommentLikes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $id_post = $request->input("id");
        $id_user = Auth::id();
        $commentText = $request->input("comment");
        $comment = new Comment();
        $comment->user_id = $id_user;
        $comment->post_id = $id_post;
        $comment->comment_text = $commentText;
        $comment->save();
        $commentsCount = Post::withCount('comments')->where('id' , $id_post)->first();
        
        return response()->json([
            'message' => 'Comment stored successfully',
            "comment" => $comment,
            "user_name" => $comment -> user -> name,
            "created_at"=> $comment -> created_at -> format('H:i:s'), 
            "commentsCount" => $commentsCount,
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
     * Add new comment like
     */
    public function add(Request $request)
    {
        $id_post = $request->input("id");
        $id_user = Auth::id();
        $comment_id = $request->input("comment_id");
        $like = new CommentLikes();
        $like->user_id = $id_user;
        $like->post_id = $id_post;
        $like->comment_id = $comment_id;
        $like->save();
        return response()->json([
            'message' => 'Comment stored successfully',
            'id' => $like->id,
            
        ]);   
    }

    /**
     * Destroy comment like
     */
    public function remove(string $id)
    {
        CommentLikes::where('id', $id)->delete();
        return json_encode($id);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::where('id', $id)->delete();
        return json_encode($id);
    }
}
