@extends('layouts.app')
@section('title', 'profile')
@vite(['resources/css/profile.css'])
@vite(['resources/js/profile.js'])
@section('body')

    {{-- <body class="bg-black text-light">
    <main class="container"> --}}

    <!------------------------------profile photo and section information---------------------------->
    <section id="header" class="row">
        <section class="col-md-4 col-3 text-center">
            <img src="{{ asset('images/profile.jpeg') }}" class="rounded-circle img-fluid w-50" alt="img" width="200px" />

        </section>
        <section class="col-md-8 col-7 ps-4 mt-5">
            <div class="d-flex gap-4">
                <h1 class="h2 fs-4">Mohamed Torkey</h1>
                <button type="button" class="btn btn-secondary fw-bold mb-3">Edit Profile</button>
            </div>
            <div class="d-flex gap-4">
                <h6 class="fs-4 mt-2"> <span class="fw-bold fs-7">23 </span>posts</h6>
                <a href="#!">
                    <h6 class="fs-5 btn btn-outline-black  text-light" data-toggle="modal" data-target="#followers"><span
                            class="fw-bold fs-7">23 </span>followers</h6>
                </a>
                <a href="#!">
                    <h6 class="fs-5 btn btn-black text-light" data-toggle="modal" data-target="#following"><span
                            class="fw-bold fs-7">23 </span>following </h6>
                </a>

            </div>
            <h2 class="h6 mt-1 fw-bold">software engineer</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipis</p>
        </section>
    </section>



    <!---------------------------------setcions Of Posts---------------------------------------------- -->
    <hr>
    <div class="d-flex justify-content-center gap-5 " style="margin-top: -21px;">
        <a href="#!">
            <h6 id="Posts" class="fs-5 text-secondary border-top border-light mt-1 p-3">
                <i class="fa-regular fa-list-ul  mt-1 "></i> POSTS
            </h6>
        </a>
        <a href="#!">
            <h6 id="Save" class="fs-5 text-secondary  mt-1 p-3"><i class="fa-regular fa-bookmark  mx-1 "></i> SAVE</h6>
        </a>
        <a href="#!">
            <h6 id="Tagged" class="fs-5  text-secondary mt-1 p-3"> <i class="fa-regular fa-user mx-1"></i>Tagged</h6>
        </a>
    </div>
    <section id="bodyPosts" class="row">
        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                <div class="container-article">
                    <img src="https://unsplash.it/800/800.jpg?image=252" alt="post title" class="image" />
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-heart text-white fs-5"></i>
                        <p class="text-white fs-5 mx-2 mt-3">33</p>
                        <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                        <p class="text-white fs-5  mt-3">33</p>
                    </div>
                </div>
            </a>
        </article>

        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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

        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                <div class="container-article">
                    <img src="https://unsplash.it/800/800.jpg?image=256" alt="post title" class="image" />
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-heart text-white fs-5"></i>
                        <p class="text-white fs-5 mx-2 mt-3">33</p>
                        <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                        <p class="text-white fs-5  mt-3">33</p>
                    </div>
                </div>
            </a>
        </article>

        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                <div class="container-article">
                    <img src="https://unsplash.it/800/800.jpg?image=257" alt="post title" class="image" />
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-heart text-white fs-5"></i>
                        <p class="text-white fs-5 mx-2 mt-3">33</p>
                        <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                        <p class="text-white fs-5  mt-3">33</p>
                    </div>
                </div>
            </a>
        </article>

        <article class="col-md-4 mt-4  w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                <div class="container-article">
                    <img src="https://unsplash.it/800/800.jpg?image=252" alt="post title" class="image" />
                    <div class="overlay d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-heart text-white fs-5"></i>
                        <p class="text-white fs-5 mx-2 mt-3">33</p>
                        <i class="fa-solid fa-comment text-white fs-5 mx-2"></i>
                        <p class="text-white fs-5  mt-3">33</p>
                    </div>
                </div>
            </a>
        </article>

        <article class="col-md-4 mt-4  w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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

        <article class="col-md-4 mt-4  w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
                <div class="container-article">
                    <img src="https://unsplash.it/800/800.jpg?image=258" alt="post title" class="image" />
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




    <!----------------------------Sections Of Save--------------------------------------------------->
    <section id="bodySave" class="row d-none">
        <article class="col-md-4 mt-4 w-25">
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
            <a data-bs-toggle="modal" data-bs-target="#exampleModal" type="button">
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
    <!----------------------------Footer--------------------------------------------------->
    <footer class="container mt-5 mb-5 px-3 text-center footer-font  ">
        <a href="#" class="px-2 text-light">About</a>
        <a href="#" class="px-2 text-light">Blog</a>
        <a href="#" class="px-2 text-light">Jobs</a>
        <a href="#" class="px-2 text-light">Help</a>
        <a href="#" class="px-2 text-light">API</a>
        <a href="#" class="px-2 text-light">Privacy</a>
        <a href="#" class="px-2 text-light">Terms</a>
        <a href="#" class="px-2 text-light">Top Accounts</a>
        <a href="#" class="px-2 text-light">Hashtags</a>
        <a href="#" class="px-2 text-light">Locations</a>
    </footer>







    <!-- --------------------modal for followers------------------------------------------------------ -->
    <div class="modal fade text-light" id="followers">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark text-light">
                <!-----------------Header of Modal----------------->
                <div class="modal-header d-flex justify-content-between gap-5" style="height: 50px;">
                    <h5 class="modal-title text-center">Followers </h5>
                    <button type="button" class="close btn btn-white" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-light"></i>
                    </button>
                </div>

                <!-----------------Search of Modal----------------->
                <div class="modal-body mt-3">
                    <div class="d-flex justify-content-center bg-dark">
                        <i class="fas fa-search fs-5 mt-1 mx-2 text-light"></i>
                        <input type="search" class="border-0 rounded-1 w-50 h-25 text-secondary bg-dark px-2"
                            placeholder="Search" />
                    </div>
                </div>


                <!---------List of followers---------------------->
                <ul class=" modal-body list-group border-0 mt-3">

                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3 mx-1">mohamedtorkey20 </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>
                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3 mx-1">mohamedtorkey20 </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>
                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3 mx-1">mohamedtorkey20 </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>
                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3 mx-1">mohamedtorkey20 </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>

                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-2">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3  mx-1">mohamedtorkey20. <a href="#!"><span
                                            class="fs-6 text-primary fw-bold">Follow</span></a> </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>

                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>

                    <li
                        class="list-group-item border-0 d-flex justify-content-between align-items-center bg-dark text-light">
                        <div class="d-flex justify-content-start align-items-center gap-1">
                            <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                alt="img" width="50px" />
                            <div class="d-flex flex-column">
                                <p class="fs-5 mt-3 mx-1">mohamedtorkey20 </p>
                                <p class="text-secondary" style="font-size:15px; font-weight: bold; margin-top:-19px;">
                                    mohamed torkey
                                </p>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-sm fs-6">Remove</button>
                        </div>
                    </li>


                    <!--------add follower-------->
                </ul>
            </div>
        </div>
    </div>
    </div>


    <!----------------------modal for following------------------------------------------------------ -->
    <div class="modal fade text-light" id="following">
        <div class="modal-dialog modal-dialog-centered text-light">
            <div class="modal-content bg-dark">
                <!-----------------Header of Modal----------------->
                <div class="modal-header d-flex justify-content-between gap-5 bg-dark text-light" style="height: 50px;">
                    <h5 class="modal-title text-center" id="exampleModalCenterTitle">Following</h5>
                    <button type="button" class="close btn btn-white" data-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times text-light"></i>
                    </button>
                </div>

                <!-----------------People and Hashtags----------------->
                <div class="mt-3 bg-dark text-light">
                    <div class="d-flex justify-content-evenly gap-5">
                        <a href="#!">
                            <h6 id="People" class="fs-5  text-secondary">People</h6>
                        </a>
                        <a href="#!">
                            <h6 id="Hashtags" class="fs-5 text-secondary ">Hashtags</h6>
                        </a>
                    </div>

                    <!-----------------Header of Modal----------------->
                    <div class=" mt-3">
                        <div class="d-flex justify-content-center bg-dark">
                            <i class="fas fa-search fs-5 mt-1 mx-2 text-light"></i>
                            <input type="search" class="border-0 rounded-1 w-50 h-25 text-secondary bg-dark px-2"
                                placeholder="Search" />
                        </div>
                    </div>


                    <!------------List of following-------------->
                    <ul id="bodyPeople" class=" modal-body list-group border-0 mt-3 bg-dark text-ligh">

                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-1 ">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>

                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>

                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>
                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>
                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>
                        <li
                            class="list-group-item  border-0 d-flex justify-content-between align-items-center  bg-dark text-light">
                            <div class="d-flex justify-content-start align-items-center gap-2">
                                <img src="{{ asset('images/bussiness-man.png') }}" class="rounded-circle img-fluid"
                                    alt="img" width="50px" />
                                <div class="d-flex flex-column mx-1">
                                    <p class="fs-5 mt-3">mohamedtorkey20 </p>
                                    <p class="text-secondary"
                                        style="font-size:15px; font-weight: bold; margin-top:-19px;">mohamed torkey
                                    </p>
                                </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary btn-sm fs-6">Follwoing</button>
                            </div>
                        </li>


                        <!----add following------->
                    </ul>


                    <!------------List of Hashtags-------------->
                    <ul id="bodyHashtags" class="list-group border-0 mt-3 d-none ">

                        <li
                            class="d-flex justify-content-center align-items-center flex-column  fs-1 mb-3 bg-dark text-light">
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

        @endsection
