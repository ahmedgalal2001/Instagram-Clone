@extends('admin.main')

@section('title')
    Posts
@endsection

@section('content')
<form action="{{ route('posts.dashboard') }}" method="GET" class="mb-3">
  <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search Posts" value="{{ $search ?? '' }}">
      <div class="input-group-append">
          <button type="submit" class="btn btn-outline-secondary">Search</button>
      </div>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="attribute[]" value="id" {{ in_array('id', $selectedAttributes) ? 'checked' : '' }}>
    <label class="form-check-label">Post ID</label>
  </div>
  <div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" name="attribute[]" value="caption" {{ in_array('caption', $selectedAttributes) ? 'checked' : '' }}>
    <label class="form-check-label">Caption</label>
  </div>
</form>

<table class="table mt-4" style="text-align: center" border="2px">
  <thead>
    <tr>
        <th scope="col">Post ID</th>
        <th scope="col">Owner Email</th>
      <th scope="col">Caption</th>
      <th scope="col">Created At</th>
      <th scope="col" width="250px">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
    <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->user->email }}</td>
        <td>{{ $post->caption }}</td>
        <td>{{ $post->created_at }}</td>
      <td>
        <form style="display: inline" action="{{ route("posts.destroy", $post->id) }}" method="POST">
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