<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    {{-- @vite(['resources/css/navbar.css']) --}}
    <style>
        .sidebar {
            background-color: #f8f9fa;
            height: 100vh;
            /* Adjust the height as needed */
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            /* Adjust the top padding to accommodate the navbar height */
            width: 200px;
            /* Adjust the width as needed */
            border-right: 1px solid #dee2e6;
        }

        .sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar ul li {
    display: block; /* Display list items as block elements */
    margin-bottom: 10px; /* Adjust margin between list items */
}
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            @auth
                <div class="col-2">
                    <div id="sidebar" class="sidebar">
                        @include('layouts.navbar')
                    </div>
                </div>
            @endauth

            <div id="app" class="app col-10">
                @yield('body')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
