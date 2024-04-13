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
                @for ($i = 0; $i < 15; $i++)
                @foreach ($suggestedUsers as $suggestedUser)
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                class="rounded-circle status-avatar" width="65px" height="65px" alt="Avatar" />
                        </a>
                        <p>{{ Str::limit($suggestedUser->name, 10) }}</p>
                    </div>
                @endforeach
                @endfor
            </div>
            <button class="right">
                <i class="fas fa-angle-right"></i>
            </button>
        </div>

        <!------- Posts side -------->
        @foreach ($posts as $post)
            <div class="card w-50 col-sm-12 col-lg-6 mt-0 mb-0 main-post-div">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <div class="row m-0">
                        <div class="col-md-12 d-flex align-items-center p-0">
                            <div class="col-12 d-flex pt-3 px-0 p-0 justify-content-start align-items-center">
                                <div class="avatar-container col-12 d-flex position-relative mb-2 mx-0">
                                    <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                        class="rounded-circle avatar" width="50px" height="50px" alt="Avatar" />
                                        <div class="w-100 d-flex flex-column justify-content-center px-2">
                                            <div class="d-flex align-ite">
                                                <a type="button" class="text-decoration-none text-dark user-name-btn">
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
                                            <p class="m-0 mt-2 text-secondary fs-6 h6"><i>Original audio</i></p>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-end">
                                            <a type="button" data-toggle="modal" 
                                                data-target="#postOptionsAlert" >
                                                <svg aria-label="More options" class="x1lliihq x1n2onr6 x5n08af" height="24"
                                                    role="img" viewBox="0 0 24 24" width="24">
                                                    <title>More options</title>
                                                    <circle cx="12" cy="12" r="1.5" fill="black"></circle>
                                                    <circle cx="6" cy="12" r="1.5" fill="black"></circle>
                                                    <circle cx="18" cy="12" r="1.5" fill="black"></circle>
                                                </svg>
                                            </a>
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
                                                                <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
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
                                                        <p class="m-0">1M</p>
                                                        <p class="m-0">followers</p>
                                                    </div>

                                                    <div class="col-4 d-flex flex-column align-items-center">
                                                        <p class="m-0">50k</p>
                                                        <p class="m-0">following</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row d-flex justify-content-between">
                                                    <div class="col-4">
                                                        <img src="{{ asset('images/dog.jpg') }}"
                                                            class="w-100 h-100 profile-post-hover">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('images/dog.jpg') }}"
                                                            class="w-100 h-100 profile-post-hover">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('images/dog.jpg') }}"
                                                            class="w-100 h-100 profile-post-hover">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6">
                                                        <button class="btn btn-primary w-100">
                                                            <i class="fa-solid fa-user"></i>
                                                            View Profile
                                                        </button>
                                                    </div>
                                                    <div class="col-6">
                                                        <button class="btn btn-primary w-100">
                                                            <i class="fa-solid fa-user-plus"></i>
                                                            follow
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!---------- End of details card ----------->
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <img src="{{ asset('images/posts/' . $post->image_url) }}" class="img-fluid" />
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">

                            <a type="button" class="post-like"
                                @foreach ($post->likes as $like)
                                @if (Auth::id() == $like->user_id && $post->id == $like->post_id)
                                style="color:red !important;"
                                data-bs-like="{{ $like->id }}"
                                @endif 
                                @endforeach
                                data-bs-post="{{ $post->id }}" id="postLike-{{ $post->id }}">
                                <h4><b><i class="fa-regular fa-heart"></i></b></h4>
                            </a>

                            <a type="button" 
                            class="comment-btn"
                            data-toggle="modal"
                            data-bs-commentBtn = "{{ $post->id }}"
                            data-target="#commentsModal">
                                <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                            </a>

                            <a type="button">
                                <h4><b><i class="far fa-paper-plane"></i></b></h4>
                            </a>


                        </div>
                        <div class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                            <a type="button"
                            @foreach($post->savedposts as $mark)
                                @if (Auth::id() == $mark->id)
                                    style="color:orange !important;"
                                @endif
                            @endforeach
                            id="book-mark-btn-{{ $post->id }}"
                            data-bs-post="{{ $post->id }}"
                            class="post-book-mark"
                            >
                                <h4><b><i class="fa-regular fa-bookmark"></i></b></h4>
                            </a>
                        </div>
                        
                    </div>
                    <div class="mt-1 d-flex align-items-start post-caption" id="{{ $post->id }}">
                        <p>
                            <a type="button">
                                <b>{{ $post->user->name }}</b>
                            </a>
                            {{ $post->caption }}
                        </p>
                    </div>
                    <div class="d-flex" id="main-likes-container-{{ $post->id }}">
                        @php
                            $allLikes = $post->likes;
                        @endphp
                        <p class="m-1 mx-0 likes-count-{{ $post->id }}">{{ count($allLikes) }} Likes</p>
                        @if (count($allLikes) <= 0)
                            {{-- <p class="m-1 mx-2" id="p-{{ $post->id }}"><b>No Likes</b></p> --}}
                            <div class="likess" id="likes-{{ $post->id }}">
                               
                            </div>
                        @else
                            <a type="button" id="a-{{$post->id}}">
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
                            </a>
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
                                                            <a type="button">
                                                                <b>{{ $comment->user->name }}</b>
                                                            </a>
                                                            {{ $comment->comment_text }}
                                                        </p>
                                                    
                                                </div>


                                                <a type="button" 
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
                                                    <h6><b><i class="fa-regular fa-heart"></i></b></h6>
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
                    <a href="#">
                        <img class="img-fluid rounded-circle test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="dog">
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
                <div class="row g-0">
                    <div class="col-md-4 w-100 d-flex">
                        <div class="avt-container m-1 d-flex align-items-center rounded-circle">
                            <div class="avatar-container position-relative">
                                <a type="button" class="avatar-link rounded-circle m-1">
                                <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                        class="rounded-circle mb-3 avatar" width="50px"
                                        height="50px" alt="Avatar" />
                                    </a>
                                </div>
                                {{-- <img class="img-fluid rounded-circle test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="ahmed" id="avatar-image"> --}}
                            <div class="popup p-0" id="popup">
                                

                                <!-- Profile details content goes here -->
                                    <div class="card w-100 px-1 pt-0 details-card">
                                        <div class="bg-image hover-overlay" data-mdb-ripple-init
                                            data-mdb-ripple-color="light">
                                            <div class="row m-0 p-0">
                                                <div class="col-9 d-flex align-items-center p-0">
                                                    <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                        <div class="avatar-container position-relative">
                                                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                                class="rounded-circle mb-3 avatar" width="50px"
                                                                height="50px" alt="Avatar" />
                                                        </div>
                                                    </div>
                                                    <div class="col-11 mx-3">
                                                        <div class="d-flex">
                                                            <p class="mb-0 h6">
                                                               {{ $suggestedUser->name }}
                                                            </p>
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
                                                    <p class="m-0">1M</p>
                                                    <p class="m-0">followers</p>
                                                </div>
    
                                                <div class="col-4 d-flex flex-column align-items-center">
                                                    <p class="m-0">50k</p>
                                                    <p class="m-0">following</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row d-flex justify-content-between">
                                                <div class="col-4">
                                                    <img src="{{ asset('images/dog.jpg') }}"
                                                        class="w-100 h-100 profile-post-hover">
                                                </div>
                                                <div class="col-4">
                                                    <img src="{{ asset('images/dog.jpg') }}"
                                                        class="w-100 h-100 profile-post-hover">
                                                </div>
                                                <div class="col-4">
                                                    <img src="{{ asset('images/dog.jpg') }}"
                                                        class="w-100 h-100 profile-post-hover">
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-6 mt-4">
                                                    <button class="btn btn-primary w-100 follow-btn-text">
                                                        <i class="fa-solid fa-user"></i>
                                                        View Profile
                                                    </button>
                                                </div>
                                                <div class="col-6 mt-4">
                                                    <button class="btn btn-primary w-100 follow-btn-text">
                                                        <i class="fa-solid fa-user-plus"></i>
                                                        follow
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <!---------- End of details card ----------->
                            </div>



                        </div>
                        <div class="col-md-9">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">{{ $suggestedUser->name }}</h6>
                                <button class="btn btn-sm text-primary">Follow</button>
                            </div>
                            <div>
                                <p class="card-text mb-2"><small class="text-muted">Suggested For You</small></p>
                            </div>
                        </div>
                    </div>
                </div>
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
        <div class="modal fade" id="postOptionsAlert" tabindex="-1" role="dialog" aria-labelledby="postOptionsAlert"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-center">
                        <h4><a type="button" class="w-100 text-decoration-none text-danger"
                            data-dismiss="modal">Unfollow</a></h4>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">Go To post</a></h4>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <h4><a type="button" class="w-100 text-decoration-none text-secondary"
                            data-dismiss="modal">Cancel</a></h4>
                    </div>

                </div>
            </div>
        </div>
        <!------------------- End of post options modal --------------------->

        <!-------------------- post likes others Modal ------------------>
        <div class="modal fade others-likes-modal" id="postOthersLikesAlert" tabindex="-1" role="dialog" aria-labelledby="postOthersLikesAlert"
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
                                    <div class="bg-image hover-overlay" data-mdb-ripple-init
                                        data-mdb-ripple-color="light">
                                        <div class="row m-0 p-0">
                                            <div class="col-9 d-flex align-items-center p-0">
                                                <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                    <div class="avatar-container position-relative">
                                                        <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                            class="rounded-circle mb-3 avatar" width="65px"
                                                            height="65px" alt="Avatar" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mx-3">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-0 h6">
                                                            Ahmed
                                                        </p>
                                                        <a type="button" data-toggle="modal" data-target="">
                                                            <svg aria-label="More options"
                                                                class="x1lliihq x1n2onr6 x5n08af" height="24"
                                                                role="img" viewBox="0 0 24 24" width="24">
                                                                <title>More options</title>
                                                                <circle cx="12" cy="12" r="1.5"
                                                                    fill="black"></circle>
                                                                <circle cx="6" cy="12" r="1.5"
                                                                    fill="black"></circle>
                                                                <circle cx="18" cy="12" r="1.5"
                                                                    fill="black"></circle>
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
