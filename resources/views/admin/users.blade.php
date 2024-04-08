@extends('admin.main')

@section('title')
    Index
@endsection

@section('content')

<table class="table mt-4" style="text-align: center">
  <thead>
    <tr>
        <th scope="col">User ID</th>
        <th scope="col">Name</th>
      <th scope="col">userName</th>
      <th scope="col">Email</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
      <td>
        <a href="" class="btn btn-primary">Show</a>
        <form style="display: inline" action="" method="POST">
          @csrf
          @method("DELETE")
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{-- {{ $posts->links() }} --}}
@endsection