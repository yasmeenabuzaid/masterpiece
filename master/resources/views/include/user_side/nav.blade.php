<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body>
    <header role="banner">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <img src="{{ asset('logo2.png') }}" alt="Logo" style="height: 45px; width: 160px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05"
                    aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse position-relative" id="navbarsExample05">
                    <ul class="navbar-nav mx-auto pl-lg-5 pl-0 d-flex align-items-center">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('all_subsalons') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('subscribe') }}">subscribe</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('more_subsalons') }}">salons</a>
                        </li>


                        @guest
                        {{--( Blade routing ) to chek if user login or not --}}
                            <li class="nav-item cta-btn2 d-flex">
                                <a href="{{ route('login') }}" class="btn btn-primary mr-2">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                            </li>
                        @else
                            @if (auth()->user()->isSuperAdmin() || auth()->user()->isOwner() || auth()->user()->isEmployee())
                                <li class="nav-item cta-btn2 d-flex">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <a href="{{ route('count') }}" class="btn btn-primary mr-2">
                                            <i class="fas fa-tachometer-alt" style="margin-right: 5px;"></i> Dashboard
                                        </a>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item cta-btn2 d-flex">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <a href="{{ route('my_booking') }}" class="btn btn-primary mr-2">
                                            <i class="fas fa-user" style="margin-right: 5px;"></i> Profile
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endif

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </header>


</body>

</html>
