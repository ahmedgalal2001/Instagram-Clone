@vite(['resources/css/navbar.css'])
@vite(['resources/js/navbar.js'])
<nav class="navbar flex-column align-items-start">
    <div class="side-one p-2 desc">
        <a class="navbar-brand text-center" href="/">
            <span >Instagram</span>
        </a>
    </div>
    <div class="side-two flex-grow-1">

        <a class="nav-link d-flex align-items-center p-2 link-navbar active" aria-current="page" href="/">
            <img class="me-2" src="{{ asset('images/home24x24.png') }}" alt="dog">
            <span class="desc">Home</span>
        </a>
        <a id="offcanvasToggle" class="nav-link d-flex link-navbar align-items-center p-2 " aria-current="page" href="#"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
            <img class="me-2" src="{{ asset('images/search24x24.png') }}" alt="dog">
            <span class="desc">Search</span>
        </a>
        <a id="offcanvasToggle" class="nav-link d-flex link-navbar align-items-center p-2 " aria-current="page" href="#"
            data-bs-toggle="offcanvas" data-bs-target="#notify" aria-controls="offcanvasScrolling">
            <img class="me-2" src="{{ asset('images/heart24x24.png') }}" alt="dog">
            <span class="desc">Notification</span>
        </a>
        <a class="nav-link d-flex align-items-center link-navbar p-2 " data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            aria-current="page" href="#">
            <img class="me-2" src="{{ asset('images/tab24x24.png') }}" alt="dog">
            <span class="desc">Create</span>
        </a>
        <a class="nav-link d-flex align-items-center link-navbar p-2 " aria-current="page" href="{{ route('profile.index') }}">
            <img width="24px" height="24px"
                src="https://img.freepik.com/free-photo/portrait-american-black-person-looking-up_23-2148749586.jpg"
                class=" rounded-circle me-2 my-profile" alt="">
            <span class="desc">Profile</span>
        </a>
    </div>
    <div class="side-thrid desc">
        <div class="dropup dropup-center">
            <a class="nav-link p-2  dropdown-toggle"id="dropdownMenuButton"
                data-bs-toggle="dropdown" href="#" aria-expanded="false">
                <img class="me-2" src="{{ asset('images/menu24x24.png') }}" alt="dog">
                <span>More</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i>
                            Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>




{{-- modal search --}}
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header d-flex flex-column">
        <h2 class="text-start w-100 mb-4">Search</h2>
        <div class="offcanvas-title w-100" id="offcanvasScrollingLabel">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">
                    <i class="fas fa-search fs-5 mt-1 mx-2"></i>
                </span>
                <input type="text" id="search-username" class="form-control p-2" placeholder="Search"
                    aria-label="search" aria-describedby="addon-wrapping">
            </div>
        </div>
    </div>
    <hr>
    <div class="offcanvas-body">
        <div id="users">
        </div>
    </div>
</div>


{{-- Notification --}}


<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
    id="notify" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header d-flex flex-column">
        <h2 class="text-start w-100 mb-2">Notification</h2>
    </div>
    <div class="offcanvas-body">
        <div id="users">
        </div>
    </div>
</div>


{{-- create posts --}}
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="modal-create-post" role="document">
        <div class="modal-content modal-content-navbar">
            <div class="modal-header p-2 justify-content-center">
                <h1 class="modal-title flex-grow-1 text-center fs-5" id="staticBackdropLabel">Create New Post</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="upload-img" class="modal-body">
                <form id="uploadForm" action="{{ route('posts.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="first-view" class="flex-column align-items-center">
                        <svg aria-label="Icon to represent media such as images or videos"
                            class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="77" role="img"
                            viewBox="0 0 97.6 77.3" width="96">
                            <title>Icon to represent media such as images or videos</title>
                            <path
                                d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z"
                                fill="currentColor"></path>
                            <path
                                d="M84.7 18.4 58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z"
                                fill="currentColor"></path>
                            <path
                                d="M78.2 41.6 61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z"
                                fill="currentColor"></path>
                        </svg>
                        <p class="my-3">Drag photos and videos here</p>

                        <div class="upload-btn-wrapper">
                            <button class="btn-navbar btn">Select form computer</button>
                            <input id="upload-img-post" class="upload-img-navbar" type="file" name="myfile" />
                        </div>
                    </div>

                    <div id="sceond-view">
                        <div class="row g-0">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 p-3">
                                <img id="img-post" class="w-100" alt="Selected Image">
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6 d-flex">
                                <div class="card-body d-flex flex-column">

                                    <a class="nav-link d-flex align-items-center py-3 " aria-current="page"
                                        href="{{ route('profile.index') }}">
                                        <img src="https://img.freepik.com/free-photo/portrait-american-black-person-looking-up_23-2148749586.jpg"
                                            class=" rounded-circle me-2 my-profile" alt="">
                                        <span>{{ Auth::user()->name }}</span>
                                    </a>
                                    <textarea class="form-control flex-sm-grow-1 custome-text-area" name="commit_message" rows="3"
                                        placeholder="Write a caption..."></textarea>
                                    <button type="submit" class="btn-navbar btn mt-2">Create Post</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
