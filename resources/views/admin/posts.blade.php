@extends('admin.main')

@section('title')
    Index
@endsection

@section('content')

<table class="table mt-4" style="text-align: center">
  <thead>
    <tr>
        <th scope="col">Post ID</th>
        <th scope="col">Owner</th>
      <th scope="col">Caption</th>
      <th scope="col">Image</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->user_id }}</td>
        <td>{{ $post->caption }}</td>
        <td>{{ $post->iamge }}</td>
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