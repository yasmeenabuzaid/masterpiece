<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* .navbar-nav .btn {
            transition: background-color 0.3s, color 0.3s;
            border-radius: 4px;
        }
        .navbar-nav .btn-outline-primary {
            border: 1px solid #007bff;
            color: #007bff;
        }
        .navbar-nav .btn-outline-primary:hover {
            background-color: #007bff;
            color: white;
        }
        .navbar-nav .btn-primary {
            background-color: #007bff;
            border: 1px solid #007bff;
        }
        .navbar-nav .btn-primary:hover {
            background-color: #0056b3;
            border: 1px solid #0056b3;
        } */
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
a{
    text-decoration: none
}
.btns{
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: center
}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <h2  style="color: #1d1d1d"><i class="fa fa-book me-3"></i>eLEARNING</h2>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="about.html" class="nav-item nav-link">About</a>
                    <a href="courses.html" class="nav-item nav-link">Courses</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu fade-down m-0">
                            <a href="team.html" class="dropdown-item">Our Team</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link">Contact</a>
                </div>
                <div class="navbar-nav ms-auto">
                    @guest
                        <a href="{{ route('login') }}" class="btn-nav">Login</a>
                        <a href="{{ route('register') }}" class="btn-nav">Register</a>
                    @else
                    <div class="btns">
                        <form id="logout-form" action="{{ route('home_psge') }}" method="POST" class="d-inline">
                            @csrf
                            <a href="{{ route('dashbourd') }}" class="btn-nav">Dashboard</a>
                        </form>
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn-nav">Logout</button>
                        </form>
                    </div>
                    @endguest
                </div>
            </div>
        </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

