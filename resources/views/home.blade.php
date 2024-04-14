@extends('layouts.app')

@section('body')
    @vite(['resources/js/home.js', 'resources/css/home.css'])

    <!--------- Gharabawy icons link ----------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    @vite(['resources/css/fontawesome-free-6.5.1-web/css/all.min.css'])
    <!------------------------------------------>

    {{-- <div class="row bg-danger"> --}}
    <div class="col-6 col-md-10 col-lg-6 col-sm-12 d-flex flex-column align-items-center">
        <!------------------------------- Menu of statue ------------------------------>
        <div class="cover">
            <button class="left">
                <i class="fas fa-angle-left"></i>
            </button>
            <div class="scroll-images d-flex align-items-start">
                @foreach ($suggestedUsers as $suggestedUser)
                    <div class="d-flex flex-column align-items-center m-2">
                        <a 
                        href="{{ url('profile/' . $suggestedUser->id) }}" 
                        type="button">
                            <img src="{{ $suggestedUser->image }}"
                                class="rounded-circle status-avatar" width="65px" height="65px" alt="Avatar" />
                        </a>
                        <p>{{ Str::limit($suggestedUser->name, 10) }}</p>
                    </div>
                @endforeach
            </div>
            <button class="right">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>

        @if ($followingPosts->count() == 0)
            <div class="d-flex flex-column justify-content-center text-secondary no-posts-message">
                <h1><i>You don't have any post ,</i></h1><br>
                <h1><i>Try to follow any one to see more posts</i></h1>
            </div>
        @endif

        <!------- Posts side -------->
        @foreach ($followingPosts as $post)
            <div class="card w-50 col-sm-12 col-lg-6 mt-0 mb-0 main-post-div">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <div class="row m-0">
                        <div class="col-md-12 d-flex align-items-center p-0">
                            <div class="col-12 d-flex pt-3 px-0 p-0 justify-content-start align-items-center">
                                <div class="avatar-container col-12 d-flex position-relative mb-2 mx-0">
                                    <img src="{{ $post->user->image }}"
                                        class="rounded-circle avatar" width="50px" height="50px" alt="Avatar" />
                                        <div class="w-100 d-flex flex-column justify-content-center px-2">
                                            <div class="d-flex align-ite">
                                                <a 
                                                href="{{ url('profile/' . $post->user->id) }}" 
                                                type="button" 
                                                class="text-decoration-none text-dark user-name-btn">
                                                    <p class="m-0 user_name_post">
                                                        <b>{{ $post->user->name }}</b>
                                                    </p>
                                                </a>
                                                @php
                                                    $posts_time = function($timestamp) {
                                                        $now = \Carbon\Carbon::now();
                                                        
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
                                                @endphp
                                                <p class="m-0 h6 text-secondary user_name_post">
                                                    <i>.{{ $posts_time($post->created_at) }}</i>
                                                </p>
                                            </div>
                                            <p class="m-0 mt-2 text-secondary fs-6 h6"><i>{{ Str::limit($post->user->bio, 20) }}</i></p>
                                        </div>

                                    

                                    <div class="profile-details-card position-absolute p-0 mt-5">
                                        <!-- Profile details content goes here -->
                                        <div class="card w-100 px-1 pt-0 details-card">
                                            <div class="bg-image hover-overlay" data-mdb-ripple-init
                                                data-mdb-ripple-color="light">
                                                <div class="row m-0 p-0">
                                                    <div class="col-9 d-flex align-items-center p-0">
                                                        <div
                                                            class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                            <div class="avatar-container position-relative">
                                                                <img src="{{ $post->user->image }}"
                                                                    class="rounded-circle mb-3 avatar" width="50px"
                                                                    height="50px" alt="Avatar" />
                                                            </div>
                                                        </div>
                                                        <div class="col-9 mx-3">
                                                            <div class="d-flex">
                                                                <p class="mb-0 h6">
                                                                    {{ $post->user->name }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        <p class="m-0">
                                                            {{ $users->where('id', $post->user->id)->first()->posts_count }}
                                                        </p>
                                                        <p class="m-0">Posts</p>
                                                    </div>

                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        @foreach($usersWithFollowersCount as $user)
                                                            @if($user->id === $post->user->id)
                                                                <div class="col-4 d-flex flex-column align-items-center">
                                                                    <p class="m-0">{{ $user->followers_count }}</p>
                                                                </div>
                                                                @endif
                                                        @endforeach
                                                        <p class="m-0">followers</p>
                                                    </div>

                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        @foreach($usersWithFollowingCount as $user)
                                                            @if($user->id === $post->user->id)
                                                            <div class="col-4 d-flex flex-column align-items-center">
                                                                <p class="m-0">{{ $user->following_count }}</p>
                                                            </div>
                                                            @endif
                                                    @endforeach
                                                        <p class="m-0">following</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row d-flex">
                                                   @foreach ($threePosts as $t_post)
                                                            @php
                                                                $posts = $t_post->posts->take(3);
                                                            @endphp
                                                            @foreach ($posts as $image)
                                                                <div class="col-4">
                                                                    @if ($image->user_id == $post->user->id)
                                                                        <img src="{{ $image->image_url }}"
                                                                        width="80vh" height="100vh">
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                    @endforeach
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6 flex-grow-1">
                                                        <a
                                                        type="button"
                                                        href="{{ url('profile/' . $post->user->id) }}" 
                                                        class="btn btn-primary w-100 h-100">
                                                            <i class="fa-solid fa-user"></i>
                                                            View Profile
                                                        </a>
                                                    </div>
                                                    @if ($post->user->id != Auth::id())
                                                    
                                                        <div class="col-6">
                                                            @if ($post->user->followers->contains(Auth::id()))
                                                                <button
                                                                type="button"
                                                                id="follow-btn-{{ $post->user->id }}"
                                                                data-bs-follow = "{{ $post->user->id }}"
                                                                data-bs-type="unfollow"
                                                                class="btn btn-secondary w-100 follow-btn">
                                                                    Unfollow
                                                                </button>
                                                            @else
                                                                <button
                                                                type="button"
                                                                id="follow-btn-{{ $post->user->id }}"
                                                                data-bs-follow = "{{ $post->user->id }}"
                                                                data-bs-type="follow"
                                                                class="btn btn-primary w-100 follow-btn"><i class="fa-solid fa-user-plus"></i>follow</button>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!---------- End of details card ----------->
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @if ($post->video == 0)
                        <img src="{{ $post->image_url }}" class="w-100 img-fluid" />
                    @else
                        <video controls autoplay src="{{ $post->image_url }}" class="img-fluid"></video>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">

                            <a type="button" class="post-like"
                                data-img-src-default="{{ asset("/images/heart_black.png") }}"
                                data-img-src="{{ asset("/images/heart.png") }}"
                                @foreach ($post->likes as $like)
                                @if (Auth::id() == $like->user_id && $post->id == $like->post_id)
                                style="color:red !important;"
                                data-bs-like="{{ $like->id }}"
                                @endif 
                                @endforeach
                                data-bs-post="{{ $post->id }}" id="postLike-{{ $post->id }}">

                                    <img 
                                    @foreach ($post->likes as $like)
                                    @if (Auth::id() == $like->user_id && $post->id == $like->post_id)
                                    src="{{ asset("/images/heart.png")}}"
                                    @endif
                                    @endforeach 
                                    src="{{ asset("/images/heart_black.png") }}"
                                    alt="">

                            </a>

                            <a type="button" class="comment-btn" data-toggle="modal"
                                data-bs-commentBtn = "{{ $post->id }}" data-target="#commentsModal">
                                <img src="{{ asset("/images/chat.png") }}" alt="">
                            </a>

                            <a type="button">
                                <img src="{{ asset("/images/send.png") }}" alt="">
                            </a>


                        </div>
                        <div class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                            <a type="button"
                            data-img-src-default="{{ asset("/images/bookmark_blak.png") }}"
                            data-img-src="{{ asset("/images/bookmark.png") }}"
                            @foreach($post->savedposts as $mark)
                                @if (Auth::id() == $mark->id)
                                    style="color:orange !important;"
                                @endif
                            @endforeach
                            id="book-mark-btn-{{ $post->id }}"
                            data-bs-post="{{ $post->id }}"
                            class="post-book-mark"
                            >
                                    <img 
                                    @foreach($post->savedposts as $mark)
                                    @if (Auth::id() == $mark->id)
                                    src="{{ asset("/images/bookmark.png") }}"
                                    @endif
                                    @endforeach 
                                    src="{{ asset("/images/bookmark_blak.png") }}"
                                    alt="">
                            </a>
                        </div>
                        
                    </div>
                    <div class="mt-1 d-flex align-items-start post-caption" id="{{ $post->id }}">
                        <p>
                            <a 
                            href="{{ url('profile/' . $post->user->id) }}" 
                            class="text-decoration-none text-dark user-name-btn"
                            type="button">
                                <b>{{ $post->user->name }}</b>
                            </a>
                            @php
                                $words = explode(' ', $post->caption);
                            @endphp

                            @foreach($words as $word)
                                @if (Str::startsWith($word, '#'))
                                    <a href="{{ url('/hashtags/' . Str::replace("#","",$word)) }}" class=" text-decoration-none text-secondary">{{ $word }}</a>
                                @else
                                    {{ $word }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="d-flex" id="main-likes-container-{{ $post->id }}">
                        @php
                            $allLikes = $post->likes;
                        @endphp
                        <p class="m-1 mx-0 likes-count-{{ $post->id }}">{{ count($allLikes) }} Likes</p>
                        @if (count($allLikes) <= 0)
                            <div class="likess" id="likes-{{ $post->id }}">
                               
                            </div>
                        @else

                                <p class="m-1" id="you-like-blade-{{ $post->id }}">
                                    <b>
                                        @php
                                            $foundUser = $post->likes[0]->user->name;
                                            $flag = 0;
                                        @endphp
                                        @foreach ($post->likes as $like)
                                                @if (Auth::id() == $like->user_id )
                                                    You
                                                    @php
                                                        $flag = 1;
                                                    @endphp
                                                @endif 
                                        @endforeach
                                        @if ($flag == 0)
                                            {{ $foundUser }}
                                        @endif
                                    </b>
                                </p>
                            <div class="likess othersContent-{{ $post->id }}" id="likes-{{ $post->id }}">
                                <p class="m-1">and</p>
                                <a type="button"  
                                data-toggle="modal"
                                data-bs-othersLikesPost = "{{ $post->id }}"
                                class = "others-post text-dark text-decoration-none"
                                data-target="#postOthersLikesAlert">
                                    <p class="m-1"><b>others</b></p>
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="d-flex flex-column">
                        <a 
                        type="button"
                        class="comment-btn text-decoration-none"
                        data-toggle="modal"
                        data-bs-commentBtn = "{{ $post->id }}"
                        data-target="#commentsModal">
                            <p class="text-secondary m-0" id="view-all-comments-{{ $post->id }}">View all {{ $post->comments->count() }} comments</p>
                        </a>
                        @if (count($post->comments) > 0)
                            <div id="post-{{ $post->id }}">
                                <div class="comments-container">
                                    @foreach ($post->comments as $comment)
                                        @if ($post->id == $comment->post_id && $comment->user_id == Auth::id())  
                                            <div class="col-md-12 mb-0 aligh-items-center d-flex justify-content-between user-comment-{{ $comment->id }}">
                                                <div class="d-flex col-10 align-items-center">
                                                        <p>
                                                            <a 
                                                            href="{{ url('profile/' . $post->user->id) }}" 
                                                            class="text-decoration-none text-dark user-name-btn"
                                                            type="button">
                                                                <b>{{ $comment->user->name }}</b>
                                                            </a>
                                                            {{ $comment->comment_text }}
                                                        </p>
                                                    
                                                </div>


                                                <a type="button" 
                                                data-img-src-default="{{ asset("/images/heart2.png") }}"
                                                data-img-src="{{ asset("/images/heart1.png") }}"
                                                    class="comment-like m-2"
                                                    id="comment-like-{{ $comment->id }}"
                                                        @foreach ($comments as $comment_like)
                                                            @if (Auth::id() == $comment_like->user_id && $post->id == $comment_like->post_id && $comment->id == $comment_like->comment_id)
                                                                    data-bs-commentLike="{{ $comment_like->id }}"
                                                                    style="color:red !important;"
                                                            @endif
                                                        @endforeach
                                                    data-bs-postCommment="{{ $comment->id }}"
                                                    data-bs-postId="{{ $post->id }}">

                                                        <img 
                                                        @foreach ($comments as $comment_like)
                                                        @if (Auth::id() == $comment_like->user_id && $post->id == $comment_like->post_id && $comment->id == $comment_like->comment_id)
                                                        src="{{ asset("/images/heart1.png") }}"
                                                        @endif
                                                        @endforeach 
                                                        src="{{ asset("/images/heart2.png") }}"
                                                        alt="">

                                                </a>

                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <h4 id="No-Comment-{{ $post->id }}"><b>No Comments</b></h4>
                            <div id="post-{{ $post->id }}">
                                <div class="comments-container">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <input type="text" name="comment" data-bs-comment="{{ $post->id }}" placeholder="Add a comment..."
                                class="comment-txt fs-6">
                        </div>
                        <div class="col-2">
                            <a type="button" 
                            
                            class="commentBtn">Post</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <!-------------------------------------------- End of Posts side ------------------------------------------->


    {{-- -------------------------------------------------Kamal--------------------------------------------------- --}}
    <div class="col-3 d-none d-lg-block mt-4">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-3 d-flex">
                    <a 
                    href="{{ url('profile/' . $loggedInUser->id) }}" 
                    href="#">
                        @if ($loggedInUser->image == null)
                            <img class="img-fluid rounded-circle test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="ahmed" id="avatar-image">
                        @else
                            <img class="img-fluid rounded-circle test" src="{{ $loggedInUser->image }}" alt="dog">
                        @endif
                    </a>
                </div>
                <div class="col-md-9 d-flex flex-column align-items-center justify-content-center">
                        <h6 class="card-title mb-0">{{ $loggedInUser->name }}</h6>
                        <p class="card-text mb-2"><small class="text-muted">Suggested For You</small></p>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-3">
            <h6 class="suggested">Suggested for you</h6>
            <button class="btn btn-sm">See All</button>
        </div>
        
        <div class="card mb-3 pb-3 pt-3">
            @foreach ($suggestedUsers as $suggestedUser)
                @if ($suggestedUser->id != Auth::id() && !$followingsIds->contains($suggestedUser->id))
            
                    <div class="row g-0">
                        <div class="col-md-4 w-100 d-flex">
                            <div class="avt-container m-1 d-flex align-items-center rounded-circle">
                                <div class="avatar-container position-relative">
                                    <a type="button" class="avatar-link rounded-circle m-1">
                                    <img src="{{ $suggestedUser->image }}"
                                            class="rounded-circle mb-3 avatar" width="50px"
                                            height="50px" alt="Avatar" />
                                        </a>
                                </div>
                                <div class="popup p-0" id="popup">
                                    

                                    <!-- Profile details content goes here -->
                                        <div class="card w-100 px-1 pt-0 details-card">
                                            <div class="bg-image hover-overlay" data-mdb-ripple-init
                                                data-mdb-ripple-color="light">
                                                <div class="row m-0 p-0">
                                                    <div class="col-9 d-flex align-items-center p-0">
                                                        <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                            <div class="avatar-container position-relative">
                                                                <img src="{{ $suggestedUser->image }}"
                                                                    class="rounded-circle mb-3 avatar" width="50px"
                                                                    height="50px" alt="Avatar" />
                                                            </div>
                                                        </div>
                                                        <div class="col-11 mx-3">
                                                            <div class="d-flex">
                                                                <a
                                                                href="{{ url('profile/' . $suggestedUser->id) }}" 
                                                                type="button" 
                                                                class="text-decoration-none text-dark">
                                                                    <p class="mb-0 h6">
                                                                        {{ $suggestedUser->name }}
                                                                    </p>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        <p class="m-0">
                                                            {{ $suggestedUser->posts_count }}
                                                        </p>
                                                        <p class="m-0">Posts</p>
                                                    </div>
        
                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        @foreach($usersWithFollowersCount as $user)
                                                            @if($user->id === $suggestedUser->id)
                                                                <div class="col-4 d-flex flex-column align-items-center">
                                                                    <p class="m-0">{{ $user->followers_count }}</p>
                                                                </div>
                                                                @endif
                                                        @endforeach
                                                        <p class="m-0">followers</p>
                                                    </div>
                                                    
        
                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        @foreach($usersWithFollowingCount as $user)
                                                            @if($user->id === $suggestedUser->id)
                                                            <div class="col-4 d-flex flex-column align-items-center">
                                                                <p class="m-0">{{ $user->following_count }}</p>
                                                            </div>
                                                            @endif
                                                        @endforeach
                                                        <p class="m-0">following</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row d-flex">
                                                   @foreach ($threePosts as $t_post)
                                                            @php
                                                                $posts = $t_post->posts->take(3);
                                                            @endphp
                                                            @foreach ($posts as $image)
                                                                @if ($image->user_id == $suggestedUser->id)
                                                                    <div class="col-4">
                                                                        <img src="{{ $image->image_url }}"
                                                                        width="80vh" height="100vh">
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                    @endforeach
                                                </div>
                                                
                                                <div class="row mt-3">
                                                    <div class="col-6 mt-4">
                                                        <a 
                                                        href="{{ url('profile/' . $suggestedUser->id) }}" 
                                                        type="button" 
                                                        class="btn btn-primary m-0 h-100 w-100">
                                                            <i class="fa-solid fa-user"></i>
                                                            Profile
                                                        </a>
                                                    </div>
                                                    @if ($suggestedUser->id != Auth::id())
                                                        <div class="col-6 mt-4">
                                                            @if ($suggestedUser->followers->contains(Auth::id()))
                                                                <button
                                                                type="button"
                                                                id="follow-btn-suggest-{{ $suggestedUser->id }}"
                                                                data-bs-follow = "{{ $suggestedUser->id }}"
                                                                data-bs-type="unfollow"
                                                                class="btn btn-secondary w-100 follow-btn">
                                                                    Unfollow
                                                                </button>
                                                            @else
                                                                <button
                                                                type="button"
                                                                id="follow-btn-suggest-{{ $suggestedUser->id }}"
                                                                data-bs-follow = "{{ $suggestedUser->id }}"
                                                                data-bs-type="follow"
                                                                class="btn btn-primary w-100 follow-btn"><i class="fa-solid fa-user-plus"></i>follow</button>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    <!---------- End of details card ----------->
                                </div>



                            </div>
                            <div class="col-md-12 d-flex col-lg-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <a
                                    href="{{ url('profile/' . $suggestedUser->id) }}" 
                                    type="button" 
                                    class="text-decoration-none text-dark">
                                        <h6 class="card-title mb-0">{{ $suggestedUser->name }}</h6>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
            <div class="row">
                <div class="col-12 mt-5 w-100 d-flex px-5">
                    <ul class="footer-links">
                        <li><a href="#">About</a></li>
                        <li><a href="#">-Help</a></li>
                        <li><a href="#">-Press</a></li>
                        <li><a href="#">-Job</a></li>
                        <li><a href="#">-Privacy</a></li>
                        <li><a href="#">-Terms</a></li>
                        <li><a href="#">-Location</a></li>
                        <li><a href="#">-Languages</a></li>
                        <li><a href="#">-Meta Verified</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
        {{-- ------------------------------------------------------------- --}}
    </div>
        <!-------------------- post options Modal ------------------>
    </div>
</div>
<!------------------- End of post options modal --------------------->

        <!-------------------- post likes others Modal ------------------>
        <div class="modal fade others-likes-modal" id="postOthersLikesAlert" tabindex="-1" role="dialog" data-bs-backdrop="static" 
        aria-hidden="true">
            
        </div>
        <!------------------- End of post options modal --------------------->

        <!------------------------- Comments Modal -------------------------->
        {{-- <div id="comment-modal"> --}}
            <div class="modal fade bg-none" id="commentsModal" tabindex="-1" role="dialog"
            aria-labelledby="commentsModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl h-100" role="document">
                <div class="modal-content">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="close border-0 bg-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-6 p-3">
                                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid" />
                            </div>
                            <div class="col-6 d-flex align-items-center justify-content-center">

                        <div class="container-fluid">
                            <!------------------- User's profile --------------------->
                            <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                                <div class="row m-0 p-0">
                                    <div class="col-9 d-flex align-items-center p-0">
                                        <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                            <div class="avatar-container position-relative">
                                                <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                    class="rounded-circle mb-3 avatar" width="65px" height="65px"
                                                    alt="Avatar" />
                                            </div>
                                        </div>
                                        <div class="col-12 mx-3">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0 h6">
                                                    Ahmed
                                                </p>
                                                <a type="button" data-toggle="modal" data-target="">
                                                    <svg aria-label="More options" class="x1lliihq x1n2onr6 x5n08af"
                                                        height="24" role="img" viewBox="0 0 24 24"
                                                        width="24">
                                                        <title>More options</title>
                                                        <circle cx="12" cy="12" r="1.5" fill="black">
                                                        </circle>
                                                        <circle cx="6" cy="12" r="1.5" fill="black">
                                                        </circle>
                                                        <circle cx="18" cy="12" r="1.5" fill="black">
                                                        </circle>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-------------------------------------------------------->
                            <hr class="mt-0">
                            <!----------------------------- Icons ---------------------->

                            <div class="row">
                                <div
                                    class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">

                                    <a type="button" class="like-btn" id="like-btn">
                                        <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                                    </a>

                                    <a type="button" id="commenr-btn">
                                        <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                    </a>

                                    <a type="button">
                                        <h4><b><i class="far fa-paper-plane"></i></b></h4>
                                    </a>


                                </div>
                                <div
                                    class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                                    <a type="button" class="bookmark-btn" id="book-mark-btn">
                                        <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex">
                                <p class="m-1 mx-0">Liked by</p>
                                <a type="button">
                                    <p class="m-1"><b>_8arabawy</b></p>
                                </a>
                                <p class="m-1">and</p>
                                <a type="button">
                                    <p class="m-1"><b>others</b></p>
                                </a>
                            </div>
                            <div class="d-flex">
                                <a type="button">
                                    <p class="text-secondary m-0">View all 23 comments</p>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-10">
                                    <input type="text" name="comment" placeholder="Add a comment..."
                                        class="comment-txt fs-6">
                                </div>
                                <div class="col-2">
                                    <a type="button">Post</a>
                                </div>
                            </div>

                            <!---------------------------------------------------------->
                            {{-- <hr class="mt-0"> --}}

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
<!----------------------- End of Comments modal ------------------------>
{{-- </div> --}}


    <!---------------------------------------------------------- For the modal ---------------------------------------------------------------->
    
@endsection
