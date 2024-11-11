<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Navbar Start -->
    <header class="site-navbar py-1" role="banner">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-6 col-xl-2" data-aos="fade-down">
                    <h1 class="mb-0">
                        <a href="#" class="text-black h2 mb-0">
                            <img src="{{ asset('logo2.png') }}" alt="Logo" style="height: 45px; width: 160px;">
                        </a>
                    </h1>
                </div>

                <div class="col-10 col-md-8 d-none d-xl-block" data-aos="fade-down">
                    <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">
                        <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                            <li><a href="{{ route('all_subsalons') }}">Home</a></li>
                            <li class="has-children">
                                <a  href="{{ route('more_subsalons') }}">Salons</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('more_subsalons') }}">Women’s Salon</a></li>
                                    <li><a href="{{ route('more_subsalons') }}">Men’s Salon</a></li>
                                    <li><a href="{{ route('more_subsalons') }}">Mixed Salon</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('all_subsalons') }}#about">About</a></li>
                            <li><a href="{{ route('all_subsalons') }}#contactus">Contact</a></li>
                            {{-- <li><a href="{{ route('my_booking') }}">My Booking</a></li> --}}
                        </ul>
                    </nav>
                </div>

                <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
                    <div class="d-none d-xl-inline-block">
                        <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                            <li class="d-flex">
                                @guest
                                    <a href="{{ route('login') }}" class="btn-nav">Login</a>
                                    <a href="{{ route('register') }}" class="btn-nav">Register</a>
                                @else
                                    <div class="btns">
                                        @if (auth()->user()->isSuperAdmin() || auth()->user()->isOwner() || auth()->user()->isEmployee())
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <a href="{{ route('dashbourd') }}" class="btn-nav mr-3">
                                                    <i class="fas fa-tachometer-alt" style="margin-right: 5px;"></i> Dashboard
                                                </a>
                                            </form>
                                        @else
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                                @csrf
                                                <a href="{{ route('my_booking') }}" class="btn-nav mr-3">
                                                    <i class="fas fa-user" style="margin-right: 5px;"></i> Profile
                                                </a>
                                            </form>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-nav">
                                                <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                                            </button>
                                        </form>
                                    </div>
                                @endguest
                            </li>
                        </ul>
                    </div>

                    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;">
                        <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                            <span class="icon-menu h3"></span>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </header>
    <!-- Navbar End -->

    <style>
        .btn-nav {
            background-color: #1d1d1d;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            height: 45px;
            width: 100px;
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
            background-color: #333333;
            color: #fff;
        }

        .btn-nav i {
            margin-right: 5px;
        }

        /* Make sure the buttons are inline and aligned */
        .site-menu.js-clone-nav.d-flex {
            display: flex;
            justify-content: flex-start;
            gap: 10px; /* Add space between buttons */
            flex-wrap: wrap; /* Allow wrapping of buttons if screen is too narrow */
            max-width: 100%; /* Prevent buttons from overflowing */
        }

        /* Add some padding for responsiveness */
        .container-fluid {
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
</body>
</html>
