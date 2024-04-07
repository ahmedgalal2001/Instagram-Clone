<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Follower;
use App\Models\Post;
use App\Models\User;
use FFI;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index()
    {



        $follows_user=User::with('following')->with('followers')->find(Auth::id());

        $posts_user = User::with('posts.comments')->find(Auth::id());

       return view('profile.index',compact('follows_user','posts_user'));
    }
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    //--------------------- add follow--------------------------------
    public function add(Request $request)
    {

        $follower=new Follower();
        $follower->follower_id=Auth::id();
        $follower->following_id=$request->input('user_id');
        $follower->save();

        return response()->json([
            'message' => 'User followed successfully',
            'count'=>User::withCount('following')->withCount('followers')->where('id',Auth::id())->first()
        ]);
    }

    //---------------remove follower----------------------------------
    public function removeFollower(string $id)
    {


        Follower::where('following_id', Auth::id())
                        ->where('follower_id', $id)
                        ->delete();

        return response()->json([
            'message' => 'Deleted',
            'count'=>User::withCount('following')->withCount('followers')->where('id',Auth::id())->first()
        ]);
    }

    //--------------un follow------------------------------------------
    public function unFollow(string $id)
    {
        Follower::where('following_id', $id)
                        ->where('follower_id', Auth::id())
                        ->delete();

        return response()->json([
            'message' => 'Deleted',
            'user' => User::withCount('following')->withCount('followers')->where('id', Auth::id())->first()
        ]);
    }
    //------------show Model Post-------------------------------------
    public  function showModelPost(string $id)
    {
        $postDetails = Post::with(['comments', 'likes'])
                                ->find($id);

        return response()->json([
            'message'=>'done',
            'postDetails'=>$postDetails,'CurrentUser'=>User::find(Auth::id())->name
        ]);
    }



}
