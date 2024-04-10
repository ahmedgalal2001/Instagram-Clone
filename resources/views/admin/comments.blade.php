@extends('admin.main')

@section('title')
    Index
@endsection

@section('content')
<table class="table mt-4" style="text-align: center">
  <thead>
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Post ID</th>
      <th scope="col">Content</th>
      <th scope="col">Created At</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
    <tr>
        <td>{{ $comment->user_id }}</td>
        <td>{{ $comment->post_id }}</td>
        <td>{{ $comment->comment_text }}</td>
        <td>{{ $comment->created_at }}</td>
      <td>
        <a href="" class="btn btn-primary">Show</a>
        <form style="display: inline" action="{{ route("comments.destroy", $comment->id) }}" method="POST">
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