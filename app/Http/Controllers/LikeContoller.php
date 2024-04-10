<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class LikeContoller extends Controller
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
        $like = new Like();
        $like->user_id = $id_user;
        $like->post_id = $id_post;
        $like->save();
        return response()->json([
            'message' => 'Comment stored successfully',
            'id' => $like->id,
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $like = Like::find($id);
        Like::where('id', $id)->delete();
        $user = Like::with('user')->where('post_id', $like->post_id)->get();
        return response()->json([
            'message' => 'Comment Deleted successfully',
            'id' => $id,
            'user' => $user,
        ]);
    }
}
