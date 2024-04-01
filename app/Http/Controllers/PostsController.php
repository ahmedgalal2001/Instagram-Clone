<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
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
        $validatedData = $request->validate([
            'commit_message' => 'string|max:255', // Assuming commit_message is a string with a maximum length of 255 characters
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
        //
    }
}
