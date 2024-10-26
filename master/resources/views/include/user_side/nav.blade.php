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
              <h1 class="mb-0"><a href="index.html" class="text-black h2 mb-0">Hairsal</a></h1>
            </div>
            <div class="col-10 col-md-8 d-none d-xl-block" data-aos="fade-down">
              <nav class="site-navigation position-relative text-right text-lg-center" role="navigation">

                <ul class="site-menu js-clone-nav mx-auto d-none d-lg-block">
                  <li class="has-children active">
                    <a href="index.html">Home</a>
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
                  </li>
                  <li class="has-children">
                    <a href="haircut.html">Haircut</a>
                    <ul class="dropdown">
                      <li><a href="#">Menu One</a></li>
                      <li><a href="#">Menu Two</a></li>
                      <li><a href="#">Menu Three</a></li>
                    </ul>
                  </li>
                  <li><a href="services.html">Services</a></li>
                  <li><a href="about.html">About</a></li>
                  <li><a href="booking.html">Book Online</a></li>
                  <li><a href="contact.html">Contact</a></li>
                </ul>
              </nav>
            </div>
            {{-- @guest
            <a href="{{ route('login') }}" class="btn-nav">Login</a>
            <a href="{{ route('register') }}" class="btn-nav">Register</a>
        @else
        <div class="btns">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <a href="{{ route('dashbourd') }}" class="btn-nav">Dashboard</a>
            </form>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn-nav">Logout</button>
            </form>
        </div>
        @endguest --}}
            <div class="col-6 col-xl-2 text-right" data-aos="fade-down">
              <div class="d-none d-xl-inline-block">
                <ul class="site-menu js-clone-nav ml-auto list-unstyled d-flex text-right mb-0" data-class="social">
                  <li>
                    <a href="#" class="pl-0 pr-3 text-black"><span class="icon-facebook"></span></a>
                  </li>
                  <li>
                    <a href="#" class="pl-3 pr-3 text-black"><span class="icon-twitter"></span></a>
                  </li>
                  <li>
                    <a href="#" class="pl-3 pr-3 text-black"><span class="icon-instagram"></span></a>
                  </li>
                  <li>
                    <a href="#" class="pl-3 pr-3 text-black"><span class="icon-youtube-play"></span></a>
                  </li>
                </ul>
              </div>

              <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-black"><span class="icon-menu h3"></span></a></div>

            </div>

          </div>
        </div>

      </header>



    <!-- Navbar End -->
