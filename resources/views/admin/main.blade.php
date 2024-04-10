<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  
    <div class="d-flex flex-column">
      <nav class="navbar navbar-expand-lg bg-dark flex-column">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a class="nav-link" href="{{route("posts.dashboard")}}">Posts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="{{route("comments.dashboard")}}">Comments</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route("users.dashboard")}}">Users</a>
              </li>
          </ul>
        </div>
      </nav>
    </div>
  
    <h1 class="mt-4 mb-4"><img style="width: 300px; margin-left:600px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Instagram_logo.svg/1280px-Instagram_logo.svg.png" alt=""></h1>
    {{-- <form action="{{ route('comments.dashboard') }}" method="GET" class="mb-3">
      <div class="input-group">
          <input type="text" name="search" class="form-control" placeholder="Search comments" value="{{ $search ?? '' }}">
          <div class="input-group-append">
              <button type="submit" class="btn btn-outline-secondary">Search</button>
          </div>
      </div>
    </form> --}}
      <div class="container">
        @yield('content')
      </div>
  </body>
</html>



<style>
  ul .nav-item a{
    color: white
  }
  ul .nav-item a:hover{
    color: rgb(180, 180, 180)
  }
</style>