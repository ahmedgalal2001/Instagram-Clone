@extends('layouts.app')
@section('title', 'profile')
@vite(['resources/css/profile.css'])
@vite(['resources/js/profile.js'])
@section('body')


    <!------------------------------profile photo and section information---------------------------->
    <div class="col-sm-12 col-md-9 col-lg-9 ">
        <section id="header" class="row ">
            <section class="col-sm-3 col-md-3  col-lg-3 offset-lg-1 mt-3  text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png" class="rounded-circle img-fluid w-55"
                    alt="img" width="200px" />

            </section>
            <section class="col-sm-8 col-md-8 col-lg-8  mt-5 ">
                <div class="d-flex gap-2 mx-5">
                    <h1 class="h2 fs-4 mx-2">Mohamedtorkey1520 </h1>
                    <a href="{{ route('profile.edit') }}" type="button" class="btn btn-primary text-light mb-3">Edit
                        Profile</a>
                    <a href="#" type="button" class="btn btn-primary text-light  mb-3">View Archive</a>
                    <a href="#" type="button" class="btn btn-white text-dark mb-3"><img
                            src="https://cdn-icons-png.flaticon.com/512/3225/3225632.png" width="25px"></a>


                </div>

                <div class="d-flex gap-4  mx-5">
                    <h6 class="fs-4 mt-2"> <span class="fw-bold fs-5">{{$follows_user->posts->count()}} </span>posts</h6>
                    <a >
                        <h6 class="fs-5 btn btn-white text-dark" data-toggle="modal" data-target="#followers"><span
                                class="count_followers fw-bold fs-7">{{$follows_user->followers->count()}} </span>followers</h6>
                    </a>
                    <a >
                        <h6 class="fs-5 btn btn-outline-white text-dark" data-toggle="modal" data-target="#following"><span
                                class="count_followings fw-bold fs-7">{{$follows_user->following->count()}} </span>following </h6>
                    </a>

                </div>
                <h2 class="h6 mt-1 fw-bold mx-5">software engineer</h2>
                <p class="mx-5">Lorem ipsum dolor sit amet consectetur adipis</p>
            </section>
        </section>



        <!---------------------------------setcions Of Posts---------------------------------------------- -->

        <hr>
        <div class="d-flex justify-content-center gap-3 " style="margin-top: -21px;">
            <a href="#!" class="custom-link">
                <h6 id="Posts" class="fs-6  border-top border-light mt-1 p-3">
                    <i class="fa-regular fa-list-ul  mt-1 " style="font-size:13px  "></i> POSTS
                </h6>
            </a>
            <a href="#!" class="custom-link">
                <h6 id="Save" class="fs-6 text-muted   mt-1 p-3"><i class="fa-regular fa-bookmark mx-1"
                        style="font-size:13px "></i> SAVE</h6>
            </a>
            <a href="#!" class="custom-link">
                <h6 id="Tagged" class="fs-6  text-muted mt-1 p-3"> <i class="fa-regular fa-user mx-1"
                        style="font-size:13px "></i>Tagged</h6>
            </a>
        </div>
        <section id="bodyPosts" class="row">


            @foreach ( $posts_user->posts as $post)
            {{-- {{$post->image_url}} --}}
            <article class="col-md-4 mt-4 w-25">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" post-id="{{$post->id}}" type="button" class="post custom-link" >
                    <div class="container-article">
                        <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png" alt="post title" height="100px" width="100px" class="image" />

                        <div class="overlay d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-heart text-white fs-5"></i>
                            <p class="text-white fs-5 mx-2 mt-3">{{$post->likes->count()}}</p>
                            <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                            <p class="text-white fs-5  mt-3">{{$post->comments->count()}}</p>
                        </div>
                    </div>
                </a>
            </article>
     @endforeach

            <!-- add new article -->
        </section>




        <!----------------------------Sections Of Save--------------------------------------------------->
        <section id="bodySave" class="row d-none">
            <article class="col-md-4 mt-4 w-25">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="custom-link" type="button">
                    <div class="container-article">
                        <img src="https://unsplash.it/800/800.jpg?image=253" alt="post title" class="image" />
                        <div class="overlay d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-heart text-white fs-5"></i>
                            <p class="text-white fs-5 mx-2 mt-3">33</p>
                            <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                            <p class="text-white fs-5  mt-3">33</p>
                        </div>
                    </div>
                </a>
            </article>

            <!-- add new article -->
        </section>



        <!----------------------------Sections Of Tagged--------------------------------------------------->
        <section id="bodyTagged" class="row d-none">
            <article class="col-md-4 mt-4 w-25">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="custom-link" type="button">
                    <div class="container-article">
                        <img src="https://unsplash.it/800/800.jpg?image=255" alt="post title" class="image" />
                        <div class="overlay d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-heart text-white fs-5"></i>
                            <p class="text-white fs-5 mx-2 mt-3">33</p>
                            <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                            <p class="text-white fs-5  mt-3">33</p>
                        </div>
                    </div>
                </a>
            </article>

            <!-- add new article -->
        </section>
        </main>


        {{-- -----------------------------modal of post ---------------------------------- --}}
        @foreach ( $posts_user->posts as $post)
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 80%; margin: 50px auto;">
                <div class="modal-content">

                    <div class="modal-body" style="max-height: calc(100vh - 50px);">

                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-6">
                                <img src="https://unsplash.it/800/800.jpg?image=253" alt="post title" class="image" />
                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between mb-1">
                                        <div class="d-flex">
                                            <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                                class="rounded-circle img-fluid" alt="img" width="35px" />
                                            <p class="fs-6 mx-2" style="font-weight: bold">{{$posts_user->name}} </p>
                                        </div>
                                        <div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <ul class="parent-comments modal-body list-group border-0 p-0 h-50 ">
                                    <li class="list-group-item border-0 p-0">
                                        <div class="d-flex justify-content-start align-items-center gap-1">
                                            <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                                class="rounded-circle img-fluid" alt="img" width="35px" />
                                            <div class="d-flex">
                                                <p class="fs-6 mx-2" style="font-weight: bold">{{$posts_user->name}} </p>
                                                <p class="caption mx-1" style="font-size:15px;"> {{$posts_user->caption}} </p>
                                            </div>

                                        </div>
                                        <div class="d-flex">
                                            <a type="button" class="custom-link">
                                                <div class="d-flex">
                                                    <a type="button" class="custom-link">
                                                        <p class="text-secondary  mx-5" style="font-size:13px;margin-top: -10px">
                                                            <a href="" class="text-secondary mx-2 custom-link">
                                                                49w
                                                            </a>


                                                        </p>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                    </li>


                                   {{-- <li class="list-group-item border-0 p-0">
                                    <div class="d-flex justify-content-start align-items-center gap-1">
                                        <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                        class="rounded-circle img-fluid" alt="img" width="35px" />
                                        <div class="commentOnPost d-flex">
                                            <p class="fs-6 mx-2" style="font-weight: bold">ahmed_43d </p>

                                        </div>

                                    </div>
                                    <div class="d-flex">
                                        <a type="button">
                                            <p class="text-secondary mx-5" style="font-size:13px;margin-top: -10px">
                                                <a href="" class="text-secondary mx-2">
                                                    49w
                                                </a>
                                                <a href="" class="text-secondary mx-2">
                                                    2likes
                                                </a>
                                                <a href="" class="text-secondary mx-2">
                                                    Reply
                                                </a>

                                            </p>
                                        </a>
                                    </div>

                                </li> --}}


                                    <!--------add comment-------->
                                </ul>
                                <hr>
                                {{------------------post icon----------------------}}
                                <div class="row">
                                    <div class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center gap-3">

                                        <a type="button" class="like-btn custom-link" id="like-btn">
                                            <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                                        </a>

                                        <a type="button" class="custom-link">
                                            <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                        </a>

                                        <a type="button" class="custom-link">
                                            <h4><b><i class="far fa-paper-plane"></i></b></h4>
                                        </a>


                                    </div>
                                    <div
                                        class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                                        <a type="button" class="bookmark-btn custom-link" id="book-mark-btn">
                                            <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <p class="m-1 mx-0">Liked by</p>
                                    <a type="button" class="custom-link">
                                        <p class="m-1"><b>mohamedtorkey1520</b></p>
                                    </a>
                                    <p class="m-1">and</p>
                                    <a type="button" class="custom-link">
                                        <p class="m-1"><b>28 others</b></p>
                                    </a>
                                </div>

                                <div class="d-flex">
                                    <a type="button" class="custom-link">
                                        <p class="text-secondary m-0 fs-6">April 21, 2023</p>
                                    </a>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-10">

                                            <input type="search" class="border-0 rounded-1 btn btn-white"
                                        placeholder="Add a comment..." />
                                    </div>
                                    <div class="col-2">
                                        <a type="button" class="custom-link">Post</a>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

        @endforeach

        <!----------------------------Footer--------------------------------------------------->
        <footer class="container mt-5 mb-5 px-3 text-center footer-font  ">
            <a href="#" class="px-2 custom-link">About</a>
            <a href="#" class="px-2 custom-link">Blog</a>
            <a href="#" class="px-2 custom-link">Jobs</a>
            <a href="#" class="px-2 custom-link">Help</a>
            <a href="#" class="px-2 custom-link">API</a>
            <a href="#" class="px-2 custom-link">Privacy</a>
            <a href="#" class="px-2 custom-link">Terms</a>
            <a href="#" class="px-2 custom-link">Top Accounts</a>
            <a href="#" class="px-2 custom-link">Hashtags</a>
            <a href="#" class="px-2 custom-link">Locations</a>
        </footer>







        <!-- --------------------modal for followers------------------------------------------------------ -->
        <div class="modal fade" id="followers">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content ">
                    <!-----------------Header of Modal----------------->
                    <div class="modal-header d-flex justify-content-between gap-5" style="height: 50px;">
                        <h5 class="modal-title text-center">Followers </h5>
                        <button type="button" class="close btn btn-" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times "></i>
                        </button>
                    </div>

                    <!-----------------Search of Modal----------------->
                    <div class="modal-body mt-3">
                        <div class="d-flex justify-content-center ">
                            <i class="fas fa-search fs-5 mt-1 mx-2"></i>
                            <input type="search" class="border-0 rounded-1 w-50 h-25  btn btn-white px-2"
                                placeholder="Search" />
                        </div>
                    </div>


                    <!---------List of followers---------------------->
                    <ul class="modal-body list-group border-0 mt-3">

                        @for ($i = 0; $i < $follows_user->followers->count() ; $i++)


                            <li class="list-group-item border-0 d-flex justify-content-between align-items-center">
                                <div class="d-flex justify-content-start align-items-center gap-1">
                                    <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                        class="rounded-circle img-fluid" alt="img" width="50px" />
                                    <div class="d-flex flex-column">
                                        <p class="fs-5 mt-3  mx-1">{{ $follows_user->followers[$i]->name }}.

                                        @if (!in_array($follows_user->followers[$i]->id, $follows_user->following->pluck('id')->toArray()))
                                            <button class=" btn btn-white follow"  follow_id="{{$follows_user->followers[$i]->id}}" ><span class="fs-6 text-primary fw-bold">Follow</span></button>
                                        @endif

                                        </p>
                                        <p class="text-secondary"
                                            style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                            {{ $follows_user->followers[$i]->name }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button"   follower-id="{{$follows_user->followers[$i]->id}}" class="remove-follower-btn btn btn-primary btn-sm fs-6">Remove</button>
                                </div>
                            </li>
                            @endfor



                        <!--------add follower-------->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
    {{--  --}}



    <!----------------------modal for following------------------------------------------------------ -->
    <div class="modal fade " id="following">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content ">
                <!-----------------Header of Modal----------------->
                <div class="modal-header d-flex justify-content-between gap-5 " style="height: 50px;">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Following</h5>
                    <button type="button" class="close btn btn-white" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-----------------People and Hashtags----------------->
                <div class="mt-3 ">
                    <div class="d-flex justify-content-evenly gap-5">
                        <a href="#!" class="custom-link">
                            <h6 id="People" class="fs-5 ">People</h6>
                        </a>
                        <a href="#!" class="custom-link">
                            <h6 id="Hashtags" class="fs-5 ">Hashtags</h6>
                        </a>
                    </div>

                    <!-----------------Header of Modal----------------->
                    <div class=" mt-3">
                        <div class="d-flex justify-content-center ">
                            <i class="fas fa-search fs-5 mt-1 mx-2 text-light"></i>
                            <input type="search" class="border-0 rounded-1 w-50 h-25  px-2" placeholder="Search" />
                        </div>
                    </div>


                    <!------------List of following-------------->
                    <ul id="bodyPeople" class="list-following modal-body list-group border-0 mt-3">


                        @foreach ($follows_user->following as $following)
                            {{-- {{$followers}} --}}
                            <li class="list-group-item  border-0 d-flex justify-content-between align-items-center ">
                                <div class="d-flex justify-content-start align-items-center gap-1 ">
                                    <img src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                        class="rounded-circle img-fluid" alt="img" width="50px" />
                                    <div class="d-flex flex-column mx-1">
                                        <p class="fs-5 mt-3">{{$following->name}} </p>
                                        <p class="text-secondary"
                                            style="font-size:15px; font-weight: bold; margin-top:-19px;">{{$following->name}}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <button type="button"  following-id="{{$following->id}}" class=" following-btn btn btn-primary  btn-sm fs-6">Following</button>
                                </div>
                            </li>
                        @endforeach


                        <!----add following------->
                    </ul>


                    <!------------List of Hashtags-------------->
                    <ul id="bodyHashtags" class="list-group border-0 mt-3 d-none ">

                        <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                            #
                            <h3>Hashtags you follow</h3>
                            <h6> Once you follow hashtags, you'll see them here.</h6>
                        </li>

                        <!----add Hashtags------->
                    </ul>



                </div>
            </div>
            {{-- </div>
     </div> --}}
        </div>





    @endsection

