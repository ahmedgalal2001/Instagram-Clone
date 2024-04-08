@extends('layouts.app')
@section('title', 'User')
@section('body')
    @vite(['resources/css/register.css'])
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6 col-lg-4">
                <div class="card rounded-0 m-4 p-5">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <div class="mb-3">
                            <input type="email" hidden name="email" value="{{ old('email', $request->email) }}"
                                class="form-control rounded-0 bg-light" id="email" placeholder="Mobile Number or Email">
                        </div>
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control rounded-0 bg-light" id="password"
                                placeholder="Password">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password_confirmation" class="form-control rounded-0 bg-light"
                                id="password" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
