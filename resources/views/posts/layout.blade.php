<!DOCTYPE html>
<html>

<head>
    <title>@yield('title')</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
        <div class="container-fluid">
            <h2 class="navbar-brand">OJT</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active ml-3" aria-current="page" href="{{ route('posts.index') }}">POST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link -ml-6" href="{{ route('categories.index') }}">CATEGORY</a>
                    </li>
                    <li class="nav-item ">
                    <a class=" btn-danger btn" href="{{ route('signout') }}">Logout</a>
                </li>
                </ul>
            </div>
        </div>
       
    </nav>
    <div class="container">
        @yield('content')
    </div>

</body>

</html>
