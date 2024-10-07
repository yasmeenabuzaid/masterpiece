@extends('layouts.app-user')

@section('content')

<!-- Header Start -->
{{-- <div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">All Salons</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="#">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">All Salons</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div> --}}
<!-- Header End -->

<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            <h1 class="mb-5">Popular Courses</h1>
        </div>

        <!-- Categories Start -->
        <div class="row mb-4 justify-content-center">
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <a href="#" class="btn btn-outline-primary w-100">Web Design</a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <a href="#" class="btn btn-outline-primary w-100">Development</a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <a href="#" class="btn btn-outline-primary w-100">Marketing</a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <a href="#" class="btn btn-outline-primary w-100">Graphic Design</a>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                <a href="#" class="btn btn-outline-primary w-100">Photography</a>
            </div>
        </div>
        <!-- Categories End -->

        <!-- Filter Start -->
        <div class="mb-4">
            <form class="d-flex justify-content-center">
                <input type="text" class="form-control me-2" placeholder="Search..." aria-label="Search">
                <button class="btn btn-primary" type="submit">Filter</button>
            </form>
        </div>
        <!-- Filter End -->

        <div class="row g-4 justify-content-center">
            @for ($i = 0; $i < 8; $i++) <!-- Adjust the count as needed -->
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="https://i.pinimg.com/236x/fa/fc/58/fafc58eac041190778c3921fcf05de47.jpg" alt="" style="width:400px">
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h3 class="mb-0">Mayar</h3>
                        <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                    </div>
                    <div class="d-flex">
                        <div class="w-100 d-flex justify-content-center bottom-0 start-0 mb-4">
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                            <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

<!-- Courses End -->

@endsection
