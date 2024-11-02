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
                  {{-- <li class="has-children ">
                    <a href="#">Home</a>
                    <ul class="dropdown">
                      <li><a href="#">Menu One</a></li>
                      <li><a href="#">Menu Two</a></li>
                      <li><a href="#">Menu Three</a></li>
                      <li class="has-children">
                        <a href="#">Sub Menu</a>
                        <ul class="dropdown">
                          <li><a href="#">Menu One</a></li>
                          <li><a href="#">Menu Two</a></li>
                          <li><a href="#">Menu Three</a></li>
                        </ul>
                      </li>
                    </ul>
                </li> --}}
                <li><a href="#hero-sec">Home</a></li>
                  <li class="has-children">
                    <a href="haircut.html">salons</a>
                    <ul class="dropdown">
                      <li><a href="#">Women’s Salon</a></li>
                      <li><a href="#">Men’s Salon</a></li>
                      <li><a href="#">Mixed Salon</a></li>
                    </ul>
                  </li>
                  <li><a href="#about">About</a></li>
                  <li><a href="booking.html">Contact</a></li>
                  <li><a href="{{route('my_booking')}}">my booking</a></li>
                </ul>
              </nav>
            </div>

            <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
              <div class="d-none d-xl-inline-block">
                <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                  <li>
                     @guest
                   <a href="{{ route('login') }}" class="btn-nav">Login</a>
                   <a href="{{ route('register') }}" class="btn-nav">Register</a>

                  </li>
                  <li>
                    @else
                    <div class="btns">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <a href="{{ route('dashbourd') }}" class="btn-nav mr-3" style="border: 2px solid #000; border-radius: 5px; padding: 5px; background-color: transparent; cursor: pointer; color: #000; width: 30px; height: 15px;">
                                <i class="fas fa-tachometer-alt" style="margin-right: 5px;"></i> Dashboard
                            </a>
                      </form>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline ">
                            @csrf
                            <button type="submit" class="btn-nav " style="border: 2px solid #000; border-radius: 5px; padding: 5px; background-color: transparent; cursor: pointer;">
                                <i class="fas fa-sign-out-alt" style="margin-right: 5px;"></i> Logout
                            </button>
                        </form>
                    </div>
                    @endguest
                  </li>
                  <li>

                </ul>
              </div>

              <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

            </div>

          </div>
        </div>

      </header>



    <!-- Navbar End -->
