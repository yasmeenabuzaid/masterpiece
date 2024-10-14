<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
        .btn-nav {
    background-color: #1d1d1d;
    color: white;
    padding: 10px 30px;
    margin-right: 10px;
    border-radius: 10px;
    height: 45px;
    border: none;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    text-decoration: none

}

.btn-nav:hover {
    color: white;

    background-color: #333333;
    transform: scale(1.0);
    text-decoration: none

}
    </style>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top">
            <div class="container">
                <a href="#" class="navbar-brand d-flex align-items-center">
                    <h2  style="color: #1d1d1d"><i class="fa fa-book me-3"></i>eLEARNING</h2>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('login') }}" class="btn-nav " >Login</a>
                        <a href="{{ route('register') }}" class="btn-nav ">Register</a>
                        @guest
                            <a href="{{ route('login') }}" class="btn-nav ">Login</a>
                            <a href="{{ route('register') }}" class="btn-nav ">Register</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
