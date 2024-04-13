@extends('layouts.app')
@section('title', 'save')
@vite(['resources/css/profile.css'])
@vite(['resources/js/SavePost.js'])
@section('body')


<div class="col-sm-12 col-md-9 col-lg-9  ">
    <section id="header" class="row">
        <section class="col-sm-3 col-md-3  col-lg-3  mx-5 mt-5">

            <a href="{{ route('profile.index', ['id' => Auth::id()]) }}" class="custom-link"><img src="https://cdn-icons-png.flaticon.com/512/15281/15281964.png" class="img-fluid" width="20px" alt=""> <span>Saved</span></a>
            <p class="SaveBack">All Posts</p>

        </section>
    <section id="bodySave" class="row" >
        @foreach ($savedPosts->savedposts as $post )

        <article class="col-md-4  mt-4 w-30">
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



        <!-- add new article -->
    </section>

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

</div>

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
                                     <img  src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png"
                                         class="avatar rounded-circle img-fluid" alt="img" width="35px" />
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


@endsection
