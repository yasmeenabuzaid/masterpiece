<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        .btn-nav {
            background-color: #007bff;
            color: white;
            padding: 4px 4px;
            border-radius: 5px;
            height: 40px;
            width: 90px;
            border: none;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            margin-right: 10px; /* Space between buttons */
            box-sizing: border-box; /* Ensure padding is included in width/height */
        }

        .btn-nav:hover {
            background-color: #1283fd;
            color: #fff;
        }

        .btn-nav i {
            margin-right: 5px;
        }


    </style>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top">
            <div class="container">
                <a href="#" class="text-black h2 mb-0">
                    <img src="{{ asset('logo2.png') }}" alt="Logo" style="height: 45px; width: 160px;">
                </a>

                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        @guest
                            <a href="{{ route('login') }}" class="btn-nav">Login</a>
                            <a href="{{ route('register') }}" class="btn-nav">Register</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>


</body>
</html>
