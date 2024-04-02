@extends('layouts.app')
@section('title', 'User')
@section('body')
    @vite(['resources/css/register.css'])
    <div class="col-12  d-flex justify-content-center align-items-center flex-column">
        <div class="col-4 col-sm-12">
            <div class="card card-body rounded-0 m-4 p-5 m-sm-1 col-sm-12">
                <div class="row d-flex flex-column">
                    <div class="text-center">
                        <a href="{{ route('login') }}"><img
                                class="img-fluid center-block w-50"src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/800px-Instagram_logo.svg.png"
                                alt=""></a>
                    </div>
                    <div class="h6 text-center text-muted red">Sign up to see photos and videos from your friends.</div>
                    <button type="submit" class="btn btn-primary ">
                        <i class="fab fa-facebook-square"></i> Log in with Facebook
                    </button>

                </div>
                <div class="m-1 text-center">
                    <p>-----------OR--------------</p>
                </div>
                <div class="row text-center">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3 ">

                            <input type="email" name="email" class="form-control rounded-0 bg-light" id="email"
                                placeholder="Mobile Number or Email">
                        </div>
                        <div class="mb-3 ">

                            <input type="text" name="name" class="form-control rounded-0 bg-light" id="name"
                                placeholder="Full Name">
                        </div>
                        <div class="mb-3 ">

                            <input type="text" name="name" class="form-control rounded-0 bg-light" id="name"
                                placeholder="UserName">
                        </div>

                        <div class="mb-3 ">

                            <input type="password" name="password" class="form-control rounded-0 bg-light" id="password"
                                placeholder="Password">
                        </div>
                        <p class="text-muted">People who use our service may have uploaded your contact information to
                            Instagram. Learn More</p>
                        <p class="text-muted">By signing up, you agree to our Terms , <a href="">Privacy Policy</a>
                            and
                            <a href="">Cookies Policy .</a>
                        </p>
                        <button type="submit" class="btn btn-primary w-100">Sign up</button>
                    </form>
                </div>

            </div>
            <div class="card card-body rounded-0 text-center m-4 d-block d-sm-none">
                <p>Have an account? <a href="{{ route('login') }}">Log in</a></p>
            </div>
            <div class="text-center mt-3">
                <p>Get the app.</p>
            </div>
            <div class="text-center">
                <img class="me-3" src={{ asset('images/googleplay.png') }} alt="googleplay" width="120px" height="40px">
                <img src={{ asset('images/microsoftstore.png') }} alt="microsoftstore" width="120px" height="40px">
            </div>
        </div>
    </div>
@endsection
