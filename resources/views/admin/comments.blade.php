@extends('admin.main')

@section('title')
    Comments
@endsection

@section('content')
<form action="{{ route('comments.dashboard') }}" method="GET" class="mb-3">
  <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search comments" value="{{ $search ?? '' }}">
      <div class="input-group-append">
          <button type="submit" class="btn btn-outline-secondary">Search</button>
      </div>
  </div>

  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="attribute[]" value="comment_text" {{ in_array('comment_text', $selectedAttributes) ? 'checked' : '' }}>
    <label class="form-check-label">Comment Text</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="attribute[]" value="user_id" {{ in_array('user_id', $selectedAttributes) ? 'checked' : '' }}>
    <label class="form-check-label">User ID</label>
  </div>

  <!-- Add more checkboxes for other attributes -->

</form>

<table class="table mt-4" style="text-align: center" border="2px">
  <thead>
    <tr>
      <th scope="col">User Email</th>
      <th scope="col">Post ID</th>
      <th scope="col">Content</th>
      <th scope="col">Created At</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($comments as $comment)
    <tr>
        <td>{{ $comment->user->email}}</td>
        <td>{{ $comment->post_id }}</td>
        <td>{{ $comment->comment_text }}</td>
        <td>{{ $comment->created_at }}</td>
      <td>
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