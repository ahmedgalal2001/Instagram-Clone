@extends('layouts.app')
@section('title', 'User')
@section('body')
    <div class="conatiner p-5">
        <div class="card card-body rounded-0 m-5 p-5 text-center">
            <div class="row d-flex flex-column">
                <div>
                    <a href="{{ route('login') }}"><img
                            class="img-fluid w-50 center-block"src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/800px-Instagram_logo.svg.png"
                            alt=""></a>
                </div>
                <div class="h6 text-center">Sign up to see photos and videos from your friends.</div>
                <button type="submit" class="btn btn-primary w-100 fa-facebook">Log in with Facebook</button>
            </div>
            <p>-----------OR--------------</p>
            <div class="row">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 ">

                        <input type="email" name="email" class="form-control rounded-0" id="email"
                            placeholder="Mobile Number or Email">
                    </div>
                    <div class="mb-3 ">

                        <input type="text" name="name" class="form-control rounded-0" id="name"
                            placeholder="Full Name">
                    </div>
                    <div class="mb-3 ">

                        <input type="text" name="name" class="form-control rounded-0" id="name"
                            placeholder="UserName">
                    </div>

                    <div class="mb-3 ">

                        <input type="password" name="password" class="form-control rounded-0" id="password"
                            placeholder="Password">
                    </div>
                    <p>People who use our service may have uploaded your contact information to Instagram. Learn More</p>
                    <p>By signing up, you agree to our Terms , <a href="">Privacy Policy</a> and <a
                            href="">Cookies Policy .</a></p>
                    <button type="submit" class="btn btn-primary w-100">Sign up</button>
                </form>
            </div>

        </div>
        <div class="card card-body rounded-0 m-5 p-5 text-center">
            <p>Have an account? <a href="{{ route('login') }}">Log in</a></p>
        </div>
    </div>
@endsection
