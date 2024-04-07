@extends('layouts.app')
@section('title', 'User')
@section('body')
    @vite(['resources/css/register.css'])
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="card rounded-0 m-4 p-5">
                    <div class="text-center">
                        <a href="{{ route('login') }}">
                            <img class="img-fluid w-50"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/800px-Instagram_logo.svg.png"
                                alt="">
                        </a>
                    </div>
                    <div class="h6 text-center text-muted red mt-3">Sign up to see photos and videos from your friends.</div>
                    <button type="submit" class="btn btn-primary mt-4">
                        <i class="fab fa-facebook-square"></i> Log in with Facebook
                    </button>
                    <div class="text-center mt-4">
                        <p>-----------OR--------------</p>
                    </div>
                    <div class="text-center">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-1">
                                <input type="email" name="email" class="form-control rounded-0 bg-light" id="email"
                                    placeholder="Mobile Number or Email">
                            </div>
                            @error('email')
                                <p class="text-danger mb-1 text-start">{{ $message }}</p>
                            @enderror
                            <div class="mb-1">
                                <input type="text" name="name" class="form-control rounded-0 bg-light" id="name"
                                    placeholder="Full Name">
                            </div>
                            @error('name')
                                <p class="text-danger mb-1 text-start">{{ $message }}</p>
                            @enderror
                            <div class="mb-1">
                                <input type="text" name="username" class="form-control rounded-0 bg-light" id="name"
                                    placeholder="User Name">
                            </div>
                            @error('name')
                                <p class="text-danger mb-1 text-start">{{ $message }}</p>
                            @enderror
                            <div class="mb-1">
                                <input type="password" name="password" class="form-control rounded-0 bg-light"
                                    id="password" placeholder="Password">
                            </div>
                            @error('password')
                                <p class="text-danger mb-1 text-start">{{ $message }}</p>
                            @enderror
                            <div class="mb-1">
                                <input type="password" name="password-confirmation" class="form-control rounded-0 bg-light"
                                    id="password" placeholder="Confirm Password">
                            </div>
                            @error('password')
                                <p class="text-danger mb-1 text-start">{{ $message }}</p>
                            @enderror
                            <p class="text-muted">People who use our service may have uploaded your contact information to
                                Instagram. Learn More</p>
                            <p class="text-muted">By signing up, you agree to our <a href="#">Terms</a>, <a
                                    href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</p>
                            <button type="submit" class="btn btn-primary w-100">Sign up</button>
                        </form>
                    </div>
                    <div class="card-footer text-center mt-4">
                        <p>Have an account? <a href="{{ route('login') }}">Log in</a></p>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <p>Get the app.</p>
                </div>
                <div class="text-center">
                    <img class="me-3" src={{ asset('images/googleplay.png') }} alt="googleplay" width="120px"
                        height="40px">
                    <img src={{ asset('images/microsoftstore.png') }} alt="microsoftstore" width="120px" height="40px">
                </div>
            </div>
        </div>
    </div>

@endsection
