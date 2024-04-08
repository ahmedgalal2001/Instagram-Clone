@extends('admin.main')

@section('title')
    Index
@endsection

@section('content')
    
<div class="text-center mt-4">
  <a href="" type="button" class="btn btn-success">Create</a>
</div>
<table class="table mt-4" style="text-align: center">
  <thead>
    <tr>
        <th scope="col">User ID</th>
        <th scope="col">User Name</th>
      <th scope="col">Email</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    {{-- @foreach ($posts as $post) --}}
    <tr>
        {{-- <td>{{ $post->user_id }}</td>
        <td>{{ $post->caption }}</td>
        <td>{{ $post->iamge }}</td> --}}
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