<?php

namespace App\Http\Controllers;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editProfileController extends Controller
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
    public function changephoto(Request $request)
    {
        $validatedData = $request->validate([
            'chgphoto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        $response = Cloudinary::upload($request->file('chgphoto')->getRealPath(), [
            "resource_type" => "auto" // Assuming Cloudinary auto-detects the resource type
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $user->image =  $response->getSecurePath();
        $user->save();
        return redirect()->action([ProfileController::class, 'edit']);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request)
    {
        // Get form data
        $userId = auth()->user()->id; // Assuming the user is authenticated
        $userData = $request->only(['website', 'bio', 'gender']);

        // Update user data
        User::where('id', $userId)->update($userData);

        // Optionally, you can redirect the user after the update
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully');
    }


    public function removeImage()
    {
        $user = User::where('id', auth()->user()->id)->first();
        $user->image = "default_pic.webp";
        $user->save();
        return redirect()->action([ProfileController::class, 'edit']);
    }
}
