<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Graeme's Bloggy</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ml-auto">
                @if (Route::has('login'))
                    @auth
                        <span class="navbar-text text-white">Hi, {{ Auth::user()->name }}</span>
                        <a href="{{ url('/dashboard') }}" class="nav-item nav-link">Dashboard</a>
                        <a href="{{ route('blogs.index') }}" class="nav-item nav-link">Blog</a>
                        <a href="{{ route('blogs.create') }}" class="nav-item nav-link">Create</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

        <div class="container mt-4">
            @yield('content')
        </div>

        <!-- Bootstrap JS and Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </div>
</body>
</html>