@extends('layouts.app')
@section('title', 'profile')
@vite(['resources/css/profile.css'])
@section('body')
    <div class="col-sm-12 col-md-9 col-lg-9 ">
        <section id="header" class="row ">
            <section class="col-sm-3 col-md-3  col-lg-3 offset-lg-1 mt-3  text-center">
                <a href="#" class="custom-link">
                    <img src="https://cdn-icons-png.flaticon.com/512/2202/2202112.png" class="rounded-circle img-fluid w-55"
                    alt="img" width="200px" />
                </a>
            </section>
            <section class="col-sm-8 col-md-8 col-lg-8  mt-5 ">
                <div class="d-flex gap-2 mx-5">
                    <h1 class="h2 fs-4 mx-2">#{{ $tagName }}</h1>
                </div>

                <div class="d-flex flex-column gap-4  mx-5">
                    <h6 class="fs-4 mt-2"> <span class="fw-bold fs-5">{{ $tagPosts->count() }}</span> <br> posts</h6>
                    <div class="col-12 mt-4">
                        <a 
                        href="#" 
                        type="button" 
                        class="btn btn-primary m-0 h-100 w-100">
                            <i class="fa-solid fa-user"></i>
                            Follow
                        </a>
                    </div>

                </div>
            </section>
        </section>



        <!---------------------------------setcions Of Posts---------------------------------------------- -->

        <p class="mt-5 mb-0">Top Posts</p>
        <section id="bodyPosts" class="row">



            @if($tagPosts->count()===0)

                <li class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 ">
                    <img src="https://cdn-icons-png.flaticon.com/512/685/685655.png" class="image w-25">
                    <h3> no posts yet</h3>
                </li>

            @else
            @foreach ( $tagPosts as $post)

            <article class="col-md-4 mt-4 w-30">
                <a post-id="{{$post->id}}" type="button" class="post custom-link" >
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
    </div>
    <!----------------------modal for following------------------------------------------------------ -->

@endsection

