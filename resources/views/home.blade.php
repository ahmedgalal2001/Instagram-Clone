@extends('layouts.app')

@section('body')
@vite(['resources/js/home.js','resources/css/home.css'])

<!--------- Gharabawy icons link ----------->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
@vite(['resources/css/fontawesome-free-6.5.1-web/css/all.min.css'])
<!------------------------------------------>

    {{-- <div class="row bg-danger"> --}}
        <div class="col-7 col-md-10 col-lg-7 col-sm-12 d-flex flex-column align-items-center">
            <!------------------------------- Menu of statue ------------------------------>
            <div class="cover">
                <button class="left">
                <i class="fas fa-angle-double-left"></i>
                </button>
                <div class="scroll-images d-flex align-items-start">
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="{{ asset('images/dog.jpg') }}" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="{{ asset('images/dog.jpg') }}" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="{{ asset('images/dog.jpg') }}" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                    <div class="d-flex flex-column align-items-center m-2">
                        <a type="button">
                            <img src="{{ asset('images/dog.jpg') }}" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                        </a>
                        <p>mohamed</p>
                    </div>
                </div>
                <button class="right">
                <i class="fas fa-angle-double-right"></i>
                </button>
            </div>
    
            <!------- Posts side -------->
            <div class="card w-50 col-sm-12 col-lg-6 mt-2 border border-dark border">
                <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                    <div class="row m-0">
                        <div class="col-md-9 d-flex align-items-center p-0">
                            <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                <div class="avatar-container position-relative mb-2">
                                    <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle avatar" width="65px" height="65px" alt="Avatar"/>
                                    <div class="profile-details-card position-absolute p-0 mt-5">
                                        <!-- Profile details content goes here -->
                                        <div class="card w-100 px-1 pt-0 details-card">
                                            <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                                                <div class="row m-0 p-0">
                                                    <div class="col-9 d-flex align-items-center p-0">
                                                        <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                                            <div class="avatar-container position-relative">
                                                                <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle mb-3 avatar" width="65px" height="65px" alt="Avatar"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-9 mx-3">
                                                            <div class="d-flex">
                                                                <p class="mb-0 h6">
                                                                    mohamed algharabawy
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
                                                        <img src="{{ asset('images/dog.jpg') }}" class="w-100 h-100 profile-post-hover">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('images/dog.jpg') }}" class="w-100 h-100 profile-post-hover">
                                                    </div>
                                                    <div class="col-4">
                                                        <img src="{{ asset('images/dog.jpg') }}" class="w-100 h-100 profile-post-hover">
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
                            <div class="col-md-9 mx-1">
                                <div class="d-flex">
                                    <p class="mb-0 h6">
                                        mohamed algharabawy
                                    </p>
                                    <p class="mb-0 h6 text-secondary">
                                        <i>.1h</i>
                                    </p>
                                </div>
                                <p class="m-0 text-secondary"><i>Original audio</i></p>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-center justify-content-end">
                            <a type="button" data-toggle="modal" data-target="#postOptionsAlert">
                                <svg aria-label="More options" class="x1lliihq x1n2onr6 x5n08af" height="24" role="img" viewBox="0 0 24 24" width="24">
                                    <title>More options</title>
                                    <circle cx="12" cy="12" r="1.5" fill="black"></circle>
                                    <circle cx="6" cy="12" r="1.5" fill="black"></circle>
                                    <circle cx="18" cy="12" r="1.5" fill="black"></circle>
                                </svg>
                            </a>
                        </div>
                    </div>
                <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">
    
                        <a type="button" id="like-btn">
                            <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                        </a>
    
                        <a type="button" id="commenr-btn" data-toggle="modal" data-target="#commentsModal">
                            <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                        </a>
    
                        <h4><b><i class="bi-share"></i></b></h4>
    
    
                    </div>
                    <div class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                        <a type="button" id="book-mark-btn">
                        <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                        </a>
                    </div>
                </div>
                <div class="d-flex">
                        <p class="m-1 mx-0">Liked by</p>
                        <a type="button"><p class="m-1"><b>_8arabawy</b></p></a>
                        <p class="m-1">and</p>
                        <a type="button"><p class="m-1"><b>others</b></p></a>
                </div>
                <div class="d-flex">
                        <a type="button"><p class="text-secondary m-0">View all 23 comments</p></a>
                </div>
                <div class="row">
                        <div class="col-10">
                            <input type="text" name="comment" placeholder="Add a comment..." class="comment-txt fs-6">
                        </div>
                        <div class="col-2">
                            <a type="button" id="submitButton">Post</a>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------- End of Posts side ------------------------------------------->
    

        {{---------------------------------------------------Kamal--------------------------------------------------- --}}
        <div class="col-3 d-none d-lg-block mt-4">
                <div class="card mb-3 " >
                    <div class="row g-0">
                        <div class="col-md-4 d-flex">
                           <a href="#"><img class="img-fluid rounded-circle test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="dog"></a>
                        </div>
                        <div class="col-md-8 ">
                            <div class="card-body d-flex justify-content-between align-items-center sugg-card">
                                <h6 class="card-title mb-0">Ahmed Kamal</h6>
                                <a class="switch mt-4 btn btn-sm">Switch</a>
                            </div>
                            <p class="card-text mb-2 "><small class="text-muted ">Suggested For You</small></p>
                        </div>
                    </div>
                </div>
                {{------------------------------------------------------------------------------------------------------------}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="suggested">Suggested for you</h6>
                    <button class="btn btn-sm">See All</button>
                </div>
                {{-- -----------------------------------------------Suggestion and Poopup------------------------------------ --}}
                <div class="card mb-3 pb-3 pt-3" >
                    @for ($i = 0; $i < 3; $i++)
                    <div class="row g-0">
                        <div class="col-md-4 w-100 d-flex">
                            <div class="avatar-container d-flex">
                                <a href="#"><img class="img-fluid rounded-circle test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="ahmed" id="avatar-image"></a>
                                <div class="popup " id="popup">
                                    <div class="d-flex align-items-center">
                                        <a href="#"><img class="img-fluid mr-3 test" src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" alt="dog"></a>
                                        <div>
                                            <h6 class="card-title mb-0">Ahmed Kamal</h6>
                                            <p>ahmed_kamal71</p>
                                        </div>
                                    </div>
                                    <div class="info mt-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="count">1000</p>
                                                <p class="label">Followers</p>
                                            </div>
                                            <div class="col-4">
                                                <p class="count">4000</p>
                                                <p class="label">Following</p>
                                            </div>
                                            <div class="col-4">
                                                <p class="count">120</p>
                                                <p class="label">Posts</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="followBtn mt-4 ">Follow</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        <div class="col-md-8 ">
                            <div class="card-body d-flex justify-content-between align-items-center sugg-card ">
                                <h6 class="card-title mb-0">Ahmed Kamal</h6>
                                <button class="btn  btn-sm mt-4 switch">Follow</button>
                            </div>
                            <p class="card-text mb-2 "><small class="text-muted ">Suggested For You</small></p>
                        </div>
                    </div>
                </div>
                @endfor
                {{-- --------------------------------------- Footer ---------------------------------------- --}}
                <div class="row ">
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
               {{-----------------------------------------------------------------}}
        </div>
    
        <!-------------------- post options Modal ------------------>
        <div class="modal fade" id="postOptionsAlert" tabindex="-1" role="dialog" aria-labelledby="postOptionsAlert" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-danger" data-dismiss="modal">Unfollow</a></h4>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">Go To post</a></h4>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">About This Account</a></h4>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <h4><a type="button" class="w-100 text-decoration-none text-secondary" data-dismiss="modal">Cancel</a></h4>
                </div>
    
            </div>
        </div>
        </div>
        <!------------------- End of post options modal --------------------->
    
        <!------------------------- Comments Modal -------------------------->
        <div class="modal fade bg-none" id="commentsModal" tabindex="-1" role="dialog" aria-labelledby="commentsModal" aria-hidden="true">
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
                        <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/111.webp" class="img-fluid"/>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
    
                        <div class="container-fluid">
                            <!------------------- User's profile --------------------->
                            <div class="bg-image hover-overlay" data-mdb-ripple-init data-mdb-ripple-color="light">
                                <div class="row m-0 p-0">
                                    <div class="col-9 d-flex align-items-center p-0">
                                        <div class="col-3 d-flex pt-3 justify-content-center align-items-center">
                                            <div class="avatar-container position-relative">
                                                <img src="https://cdn-icons-png.flaticon.com/128/15375/15375366.png" class="rounded-circle mb-3 avatar" width="65px" height="65px" alt="Avatar"/>
                                            </div>
                                        </div>
                                        <div class="col-12 mx-3">
                                            <div class="d-flex justify-content-between">
                                                <p class="mb-0 h6">
                                                    mohamed algharabawy
                                                </p>
                                                <a type="button" data-toggle="modal" data-target="">
                                                    <svg aria-label="More options" class="x1lliihq x1n2onr6 x5n08af" height="24" role="img" viewBox="0 0 24 24" width="24">
                                                        <title>More options</title>
                                                        <circle cx="12" cy="12" r="1.5" fill="black"></circle>
                                                        <circle cx="6" cy="12" r="1.5" fill="black"></circle>
                                                        <circle cx="18" cy="12" r="1.5" fill="black"></circle>
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
                                <div class="col-4 col-lg-4 col-md-6 col-sm-6 d-flex align-items-center justify-content-between">
    
                                    <a type="button" id="like-btn">
                                        <h4><b><i id="like-icon" class="fa-regular fa-heart"></i></b></h4>
                                    </a>
    
                                    <a type="button" id="commenr-btn" data-toggle="modal" data-target="#commentsModal">
                                        <h4><b><i class="fa-regular fa-comment"></i></b></h4>
                                    </a>
    
                                    <h4><b><i class="bi-share"></i></b></h4>
    
    
                                </div>
                                <div class="col-8 col-lg-8 col-md-6 col-sm-6 d-flex align-items-center justify-content-end">
                                    <a type="button" id="book-mark-btn">
                                    <h4><b><i id="book-mark-icon" class="fa-regular fa-bookmark"></i></b></h4>
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex">
                                    <p class="m-1 mx-0">Liked by</p>
                                    <a type="button"><p class="m-1"><b>_8arabawy</b></p></a>
                                    <p class="m-1">and</p>
                                    <a type="button"><p class="m-1"><b>others</b></p></a>
                            </div>
                            <div class="d-flex">
                                    <a type="button"><p class="text-secondary m-0">View all 23 comments</p></a>
                            </div>
                            <div class="row">
                                    <div class="col-10">
                                        <input type="text" name="comment" placeholder="Add a comment..." class="comment-txt fs-6">
                                    </div>
                                    <div class="col-2">
                                        <a type="button" >Post</a>
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
        <!----------------------- End of Comments modal ------------------------>
    {{-- </div> --}}


    <!---------------------------------------------------------- For the modal ---------------------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

@endsection