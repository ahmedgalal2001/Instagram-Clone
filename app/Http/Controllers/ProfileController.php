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

        $posts_user = User::with('posts.comments')->with('posts.likes')->find(Auth::id());


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


        $followers=User::with('followers')->find(Auth::id());

        return response()->json([
            'message' => 'Deleted',
            'count'=>User::withCount('following')->withCount('followers')->where('id',Auth::id())->first(),
            'followers'=>$followers
        ]);
    }

    public function showFollowers(string $followerName='')
    {



            $userWithFollowers = User::with('followers')->find(Auth::id());

            $userWithFollowings = User::with('following')->find(Auth::id());

            $followingsId = $userWithFollowings->following->pluck('id');


            if ($userWithFollowers) {

                $followers = $userWithFollowers->followers;

                $followers_search = $followers->filter(function ($follower) use ($followerName) {

                   return strpos($follower->name, $followerName) !== false;

                });

                $jsonResponse = json_encode([
                    'followers'=>$followers_search,
                    'followingsIds'=>$followingsId
                ]);

                return response($jsonResponse);
            }
    }

    public function showFollowings(string $followingName='')
    {
        $userWithFollowings = User::with('following')->find(Auth::id());


        if ($userWithFollowings) {

            $following = $userWithFollowings->following;

            $followings_search = $following->filter(function ($following) use ($followingName) {

               return strpos($following->name, $followingName) !== false;

            });

            $jsonResponse = json_encode([
                'followings'=>$followings_search
            ]);

            return response($jsonResponse);
        }

    }
    //----------------Show Hashtags----------------------------------
    public function showHashtags()
    {

    }


    public  function showLikes()
    {
        $userWhoLiked=[];
        $posts_user = User::with(['posts.likes.user'])->find(Auth::id());
        foreach ($posts_user->posts as $post) {
            foreach ($post->likes as $like) {
                $userWhoLiked[] = $like->user; // Access user who liked the post

            }
        }

        return response()->json([
            'userLiked'=>$userWhoLiked
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
            'count' => User::withCount('following')->withCount('followers')->where('id', Auth::id())->first()
        ]);
    }
    //------------show Model Post-------------------------------------
    public  function showModelPost(string $id)
    {
        $postDetails = Post::with(['comments', 'likes'])
                                ->find($id);

                                $userWhoLiked=[];



        return response()->json([
            'message'=>'done',
            'postDetails'=>$postDetails,'CurrentUser'=>User::find(Auth::id())->name
        ]);
    }

    public function savePosts()
    {
        return view('profile.showSave');
    }



}
