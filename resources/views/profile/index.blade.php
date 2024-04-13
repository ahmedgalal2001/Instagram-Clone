@extends('layouts.app')
@section('title', 'profile')
@vite(['resources/css/profile.css'])
@vite(['resources/js/profile.js'])
@section('body')


    <!------------------------------profile photo and section information---------------------------->
    <div class="col-sm-12 col-md-9 col-lg-9 ">
        <section id="header" class="row ">

            @if ($Current_Usr !== null && $id == $Current_Usr->id)

            <section class="col-sm-3 col-md-3 mx-1 mt-5 col-lg-3 offset-lg-1 mt-3  text-center">
                <a href="{{ route('profile.index', ['id' => Auth::id()]) }} "class="custom-link">


                    <img  width="150px" height="150px" src="{{$Current_Usr->image}}"
                class=" rounded-circle " alt="">
                </a>

            </section>
            <section class="col-sm-8 col-md-7 col-lg-7  mt-5 ">
                <div class="d-flex gap-2 mx-3">
                    <h1 class="h2 fs-4 mx-2">{{$Current_Usr->name}}</h1>
                    <a  href="{{ route('profile.edit')}}" type="button" class="btn btn-primary text-light mb-3">Edit
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
                <h2 class="h6 mt-1 fw-bold mx-5">{{$Current_Usr->bio
                }}</h2>
                <p class="mx-5">Lorem ipsum dolor sit amet consectetur adipis</p>
            </section>

            @else

            <section class="col-sm-3 col-md-3  col-lg-3 offset-lg-1 mt-3  text-center">
                <a href="{{ route('profile.index', ['id' =>$id ]) }}" class="custom-link">

                    <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png" class="rounded-circle img-fluid w-55"
                    alt="img" width="200px" />
                </a>

            </section>
            <section class="col-sm-8 col-md-8 col-lg-8  mt-5 ">
                <div class="d-flex gap-2 mx-5">
                    <h1 class="h2 fs-4 mx-2">{{$user->name}}</h1>
                    @if ($followingsIdForCurrentUsr->contains($user->id))
                    <a user-id="{{$user->id}}" class="FollowUser btn btn-primary text-light mb-3">
                        Following
                    </a>
                @else
                    <a user-id="{{$user->id}}" class="FollowUser btn btn-primary text-light mb-3">
                        Follow
                    </a>
                @endif


                    <a  type="button" class="btn btn-primary text-light  mb-3">Message</a>
                    <a type="button" class="btn btn-white text-dark mb-3"><img
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


            @endif



        </section>



        <!---------------------------------setcions Of Posts---------------------------------------------- -->

        <hr>
        <div class="d-flex justify-content-center gap-2 " style="margin-top: -21px;">
            <a  class="custom-link">
                <h6 id="Posts" class="fs-6  border-top border-light mt-1 p-3">
                    <i class="fa-regular fa-list-ul  mt-1 " style="font-size:13px  "></i> POSTS
                </h6>
            </a>
            @if ($Current_Usr !== null && $id == $Current_Usr->id)

            <a  class="custom-link">
                <h6 id="Save" class="fs-6 text-muted   mt-1 p-3"><i class="fa-regular fa-bookmark mx-1"
                        style="font-size:13px "></i> SAVE</h6>
            </a>
            @else
            <a  class="custom-link d-none">
                <h6 id="Save" class="fs-6 text-muted   mt-1 p-3"><i class="d-none fa-regular fa-bookmark mx-1"
                        style="font-size:13px "></i> SAVE</h6>
            </a>
            @endif
            <a class="custom-link">
                <h6 id="Tagged" class="fs-6  text-muted mt-1 p-3"> <i class="fa-regular fa-user mx-1"
                        style="font-size:13px "></i>Tagged</h6>
            </a>
        </div>
        <section id="bodyPosts" class="row">



            @if($posts_user->posts->count()===0)

                <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                    <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                    <h3> no posts yet</h3>
                </li>

            @else
                @foreach ( $posts_user->posts as $post)

            <article class="col-md-3 mx-0 mt-4 w-30 offset-1">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" post-id="{{$post->id}}" type="button" class="post custom-link" >
                    <div class="container-article">
                        @if ($post->video == 0)
                        <img src="{{$post->image_url}}" alt="post title" height="100px" width="100px" class="image" />
                    @else
                        <video controls src="{{$post->image_url }}" class="img-fluid"></video>
                    @endif
                        <div class="overlay d-flex justify-content-center align-items-center">
                            <i class="fa-solid fa-heart text-white fs-5"></i>
                            <p class="countLikePost text-white fs-5 mx-2 mt-3">{{$post->likes->count()}}</p>
                            <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                            <p class="countcommentPost text-white fs-5  mt-3">{{$post->comments->count()}}</p>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach

        @endif
            <!-- add new article -->
        </section>




        <!----------------------------Sections Of Save--------------------------------------------------->
        <section id="bodySave" class="row d-none">
            @if ($savedPosts->savedposts->count()!==0)
            <article class="col-md-4  mt-4 w-30">
                <a  href="{{route('profile.save')}}" class="custom-link" type="button">
                    <div class="container-article">
                        <img src="{{$savedPosts->posts[0]->image_url}}" alt="post title" class="image" />
                        <div class="overlay d-flex justify-content-center align-items-center">
                            <p class="text-white fs-5 mx-2 mt-3">All Posts</p>
                        </div>
                    </div>
                </a>
            </article>
            @else
            <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                <h3> no posts saved yet</h3>
            </li>

            @endif

            <!-- add new article -->
        </section>



        <!----------------------------Sections Of Tagged--------------------------------------------------->
        <section id="bodyTagged" class="row d-none">
            <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                <h3> no Tagged yet</h3>
            </li>
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
                            <div class="img_post col-12 col-md-6 col-lg-6 ">

                            </div>

                            <div class="col-12 col-md-6 col-lg-6">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-between  main-post-div mb-1">
                                        <div class="d-flex avatar-container">
                                            <img src="{{$Current_Usr->image}}" class="rounded-circle" alt="img" height="35px" width="35px" />

                                                    {{-- ----------------------------------------------------------- --}}
                                                <div class="profile-details-card d-none position-absolute p-0 mt-5" style="width:30%;z-index: 1;">
                                                    <!-- Profile details content goes here -->

                                                    {{-- ---------------------------- --}}
                                                </div>
                                            <p class="fs-6 mx-2" style="font-weight: bold">{{$posts_user->name}} </p>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center gap-3">
                                            <div class="d-flex align-items-center justify-content-end">
                                                <a type="button" data-toggle="modal" data-target="#postOptionsAlert">
                                                    <svg aria-label="More options" class="savePost x1lliihq x1n2onr6 x5n08af" height="24"
                                                        role="img" viewBox="0 0 24 24" width="24">
                                                        <title>More options</title>
                                                        <circle cx="12" cy="12" r="1.5" fill="black"></circle>
                                                        <circle cx="6" cy="12" r="1.5" fill="black"></circle>
                                                        <circle cx="18" cy="12" r="1.5" fill="black"></circle>
                                                    </svg>
                                                </a>
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <hr>
                                </div>

                                <ul class="parent-comments modal-body list-group border-0 p-0 h-50 ">
                                    <li class="list-group-item border-0 p-0">
                                        <div class="d-flex justify-content-start align-items-center gap-1">
                                            <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png"
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



                                    <!--------add comment-------->
                                </ul>
                                <hr>
                                {{------------------post icon----------------------}}

                                <div class="row">
                                    <div class="postIcon col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center gap-3">

                                        <a type="button" class="like-btn" data-post-id="{{ $post->id }}" data-user-id="{{$post->user_id}}">
                                            <i class="far fa-heart"></i>
                                        </a>


                                        <a type="button" class="custom-link">
                                            <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                        </a>

                                        <a type="button" class="custom-link">
                                            <h4><b><i class="far fa-paper-plane"></i></b></h4>
                                        </a>


                                    </div>
                                    <div class="parentBookMark col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">

                                    </div>
                                </div>
                                <div class="d-flex usersLiked">

                                </div>

                                <div class="d-flex dateOfPost">

                                </div>

                                <hr>

                                <div class="row parentComment">

                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>

                <!-------------------- post options Modal ------------------>
        <div class="modal fade" id="postOptionsAlert" tabindex="-1" role="dialog" aria-labelledby="postOptionsAlert"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="parentDelete modal-header d-flex justify-content-center">

                </div>
                <div class="modal-body d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">Go To
                            post</a></h4>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">About
                            This Account</a></h4>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary"
                            data-dismiss="modal">Cancel</a></h4>
                </div>

            </div>
        </div>
        </div>
        @endforeach

<!------------------- End of post options modal --------------------->
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
                    <ul User-id={{$user->id}} class="parentFollowers modal-body list-group border-0 mt-3">


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
                    <ul id="bodyPeople" user-id={{$user->id}} class="parentFollowings list-following modal-body list-group border-0 mt-3">

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

