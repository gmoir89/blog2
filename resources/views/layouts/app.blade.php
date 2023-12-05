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
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <div class="row w-100 justify-content-between">
            <div class="col-auto">
                <span class="navbar-brand mb-0 h1 text-white">Graeme's Bloggy</span>
            </div>
            @if (Route::has('login'))
                <div class="col-auto text-center">
                    @auth
                        <span class="navbar-text text-white">Hi, {{ Auth::user()->name }}</span>
                        <a href="{{ url('/dashboard') }}" class="btn btn-light">Dashboard</a>
                        <a href="{{ route('blogs.index') }}" class="btn btn-light">Blog</a>
                        <a href="{{ route('blogs.create') }}" class="btn btn-light">Create</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-light">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
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