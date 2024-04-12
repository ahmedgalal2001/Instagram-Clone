<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with("posts")->withCount("likes")->get();
        return view("users.index")->with("users", $users);
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
        $requestData = $request->all();
        $filename = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('image', $filename, 'public');
        $requestData["photo"] = '/storage/' . $path;
        User::create($requestData);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $username = null)
    {
        if ($username) {
            $users = User::where("name", "like", "%$username%")->get();
            return json_encode($users);
        } else {
            $user = User::where("id", Auth::id())->first();
            return json_encode($user);
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
        //
    }
}
