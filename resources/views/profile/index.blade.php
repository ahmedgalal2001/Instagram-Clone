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
                    <a class="followers">
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
            {{-- {{$post->likes}} --}}
            <article class="col-md-4 mt-4 w-30">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" post-id="{{$post->id}}" type="button" class="post custom-link" >
                    <div class="container-article">
                        <img src="https://unsplash.it/800/800.jpg?image=257" alt="post title" height="100px" width="100px" class="image" />

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
            <article class="col-md-4 mt-4 w-30">
                <a  href="{{route('profile.save')}}" class="custom-link" type="button">
                    <div class="container-article">
                        <img src="https://unsplash.it/800/800.jpg?image=253" alt="post title" class="image" />
                        <div class="overlay d-flex justify-content-center align-items-center">
                            <p class="text-white fs-5 mx-2 mt-3">All Posts</p>
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
                                    <div class="col-12 d-flex justify-content-between  main-post-div mb-1">
                                        <div class="d-flex avatar-container">
                                            <img  src="https://cdn-icons-png.flaticon.com/512/219/219970.png"
                                                class="avatar rounded-circle img-fluid" alt="img" width="35px" />
                                                    {{-- ----------------------------------------------------------- --}}
                                                <div class="profile-details-card d-none position-absolute p-0 mt-5" style="width:30%;z-index: 1;">
                                                    <!-- Profile details content goes here -->
                                                    <div class="card w-100 px-1 pt-0  details-card">
                                                        <div class="bg-image hover-overlay" data-mdb-ripple-init
                                                            data-mdb-ripple-color="light">
                                                            <div class="row m-0 p-0">
                                                                <div class="col-9 d-flex align-items-center p-0">
                                                                    <div
                                                                        class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                                        <div class=" position-relative avatar-container">
                                                                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png"
                                                                                class="rounded-circle mb-3 avatar" width="65px"
                                                                                height="65px" alt="Avatar" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-9 mx-3">
                                                                        <div class="d-flex">
                                                                            <p class="mb-0 h6">


                                                                                mohamedtorkey
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row d-flex justify-content-between">
                                                                <div class="col-4 d-flex flex-column align-items-center">
                                                                    <p class="m-0">2200</p>
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
                                                    {{-- ---------------------------- --}}
                                                </div>
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
                                <div class="d-flex usersLiked">

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
                            <input type="search" class="searchFollowers border-0 rounded-1 w-50 h-25  btn btn-white px-2"
                                placeholder="Search" />
                        </div>
                    </div>


                    <!---------List of followers---------------------->
                    <ul class="parentFollowers modal-body list-group border-0 mt-3">


                    </ul>
                </div>
            </div>
        </div>
    </div>



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

                    <!-----------------Search of Modal----------------->

                    <div class="modal-body mt-3">
                        <div class="d-flex justify-content-center ">
                            <i class="fas fa-search fs-5 mt-1 mx-2"></i>
                            <input type="search" class="searchFollowings border-0 rounded-1 w-50 h-25  btn btn-white px-2"
                                 placeholder="Search" />
                        </div>
                    </div>
                    <!------------List of following-------------->
                    <ul id="bodyPeople" class="parentFollowings list-following modal-body list-group border-0 mt-3">

                    </ul>


                    <!------------List of Hashtags-------------->
                    <ul id="bodyHashtags" class="parentHastags list-group border-0 mt-3 d-none ">

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

