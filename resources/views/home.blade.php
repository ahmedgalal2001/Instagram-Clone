@extends('layouts.app')
@section('body')
    <div class="col-10">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        @auth
                            <p>Welcome back, {{ Auth::user()->name }}!</p>
                            <p>You are now logged in.</p>
                        @else
                            <p>Welcome to our website!</p>
                            <p>Please <a href="{{ route('login') }}">login</a> or <a href="{{ route('register') }}">register</a>
                                to continue.</p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
