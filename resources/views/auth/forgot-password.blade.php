@extends('layouts.app')
@section('title', 'User')
@section('body')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="card rounded-0 m-4">
                    <div class="p-5">
                        <div class="text-center">
                            <a href="{{ route('login') }}">
                                <img class="img-fluid w-50"
                                    src="https://cdn3.iconfinder.com/data/icons/glypho-generic-icons/64/lock-circle-512.png"
                                    alt="">
                            </a>
                        </div>
                        <div class="h6 text-center red mt-3">Trouble logging in?</div>
                        <div class="text-center mt-3 ">
                            <p>Enter your email, phone, or username and we'll send you a link to get back into your account.
                            </p>
                            <div class="text-center">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="email" name="email" class="form-control rounded-0 bg-light"
                                            id="email" placeholder="Mobile Number or Email">
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Send Login Link</button>
                                </form>
                            </div>
                            <div class="text-center mt-4">
                                <p>-----------OR--------------</p>
                            </div>

                            <div class=" text-center mt-4">
                                <a href="{{ route('register') }}">Create an account</a>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card-footer text-center">
                        <a href="{{ route('login') }}">Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    @endsection
