@extends('admin.main')

@section('title')
    Users
@endsection

@section('content')
<div class="container">
    <div class="row">
        <table class="table mt-4" style="text-align: center"  border="2px" >
            <thead>
              <tr>
                  <th scope="col">User ID</th>
                  <th scope="col">Name</th>
                <th scope="col">userName</th>
                <th scope="col">Email</th>
                <th scope="col">Bio</th>
                <th scope="col">Gender</th>
                <th scope="col">Creation</th>
                <th scope="col" width="250px">Actions</th>
              </tr>
            </thead>
            <tbody>
              {{-- @foreach ($users as $user) --}}
              <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->bio }}</td>
                  <td>{{ $user->gender }}</td>
                  <td>{{ $user->created_at}}</td>
                <td>
                  <a href="{{ route('users.showUser', $user->id) }}" class="btn btn-primary">Show</a>
                  <form style="display: inline" action="{{ route("users.destroy", $user->id) }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              {{-- @endforeach --}}
            </tbody>
          </table>
</div>
</div>
</div>
@endsection