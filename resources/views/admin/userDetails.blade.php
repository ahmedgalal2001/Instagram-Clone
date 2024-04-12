@extends('admin.main')

@section('title')
    Users
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card text-bg-primary mt-4 " style="max-width: 25rem;">
                <div class="card-header">Full Name</div>
                <div class="card-body">
                    <h5 class="card-title">{{$user->name}}</h5>
                </div>
            </div>
            <div class="card text-bg-primary mt-4" style="max-width: 25rem;">
                <div class="card-header">Email</div>
                <div class="card-body">
                    <h5 class="card-title">{{$user->email}}</h5>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-bg-success mt-4" style="max-width: 25rem;">
                <div class="card-header">User_Name</div>
                <div class="card-body">
                    <h5 class="card-title">{{$user->username}}</h5>
                </div>
            </div>
        <div class="card text-bg-success mb-3 mt-4 " style="max-width: 25rem;">
            <div class="card-header">Gender</div>
            <div class="card-body">
        <h5 class="card-title">{{$user->gender}}</h5>
    </div>
</div>
</div>
<div class="col-4">

    <div class="card text-bg-secondary mb-3 mt-4 " style="max-width: 25rem;">
        <div class="card-header">Bio</div>
        <div class="card-body">
            <h5 class="card-title">{{$user->bio}}</h5>
        </div>
    </div>
    <div class="card text-bg-secondary mb-3 mt-4 " style="max-width: 25rem;">
        <div class="card-header">On Instagram Since:</div>
        <div class="card-body">
            <h5 class="card-title">{{$user->created_at}}</h5>
        </div>
    </div>
</div>
</div>
</div>
{{-- @isset($post->image)
    <div class="card text-bg-success mb-3" style="max-width: 18rem;">
        <div class="card-header">Image</div>
        <div class="card-body">
        <img src="{{Storage::disk('public')->url($post->image)}}" alt="alt">
      </div>
    </div>
  @endisset --}}
@endsection