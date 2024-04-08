@extends('layouts.app')
@section('title', 'User')
@section('body')
    @vite(['resources/css/login.css'])
    <div class="col-12 d-flex justify-content-center align-items-center " id="login">
        <div class="col-md-6 col-lg-6  img-fluid text-center d-none d-lg-block">
            <img src={{ asset('images/login.png') }} alt="LoginPage">
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4">
            <div class="border p-5">
                <div class="text-center">
                    <a href="{{ route('login') }}">
                        <img class="img-fluid w-50"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/800px-Instagram_logo.svg.png"
                            alt="">
                    </a>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-1 ">
                        <input type="email" name="email" class="formborder form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Phone number,username, or email">
                    </div>
                    @error('email')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class="mb-3 ">
                        <input type="password" name="password" class=" form-control" id="exampleInputPassword1"
                            placeholder="password">
                    </div>
                    @error('password')
                        <p class="alert alert-danger">{{ $message }}</p>
                    @enderror
                    <div class=" mb-3">
                        <button type="submit" class="btn lightblue w-100 text-light">Login</button>
                    </div>
                    <div>
                        <hr
                            style='border: none; border-bottom: 1px solid black; width: 40%; display: inline-block; margin: 0 1px;'>
                        OR
                        <hr
                            style='border: none; border-bottom: 1px solid black; width: 40%; display: inline-block; margin: 0 1px;'>
                    </div>
                    <p class="text-center blue mt-3"><i class="fa-brands fa-square-facebook blue"></i> Log in with Facebook
                    </p>
                    <div class="text-center">
                        <a href="{{ route('password.request') }}">forget password?</a>
                    </div>
                </form>
            </div>
            <div class="border mt-3 w-100 p-3 text-center">
                <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
            </div>
            <div class="text-center mt-3">
                <p>Get the app.</p>
            </div>
            <div class="text-center ">
                <img class="me-3" src={{ asset('images/googleplay.png') }} alt="googleplay" width="120px" height="40px">
                <img src={{ asset('images/microsoftstore.png') }} alt="microsoftstore" width="120px" height="40px">
            </div>
        </div>
        <div class="col-0 col-sm-0 col-md-0 col-lg-2"></div>

    </div>
@endsection
