@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @extends('layouts.app-user')

                    @section('content')


                        <!-- Carousel Start -->
                        <div class="container-fluid p-0 mb-5">
                            <div class="owl-carousel header-carousel position-relative">
                                <div class="owl-carousel-item position-relative">
                                    <video class="img-fluid" autoplay loop muted style="height: 700px; width: 100%; object-fit: cover;">
                                        <source src="../salon.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div class="col-sm-10 col-lg-8">
                                                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5>
                                                    <h1 class="display-3 text-white animated slideInDown">The Best Online Learning Platform</h1>
                                                    <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                                    <a href="{{route('all_salons')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    {{--


                                <div class="owl-carousel-item position-relative">
                                    <img class="img-fluid" src="img/carousel-2.jpg" alt="">
                                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center" style="background: rgba(24, 29, 56, .7);">
                                        <div class="container">
                                            <div class="row justify-content-start">
                                                <div class="col-sm-10 col-lg-8">
                                                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses</h5>
                                                    <h1 class="display-3 text-white animated slideInDown">Get Educated Online From Your Home</h1>
                                                    <p class="fs-5 text-white mb-4 pb-2">Vero elitr justo clita lorem. Ipsum dolor at sed stet sit diam no. Kasd rebum ipsum et diam justo clita et kasd rebum sea sanctus eirmod elitr.</p>
                                                    <a href="" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read More</a>
                                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Carousel End -->


                        <!-- Service Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="service-item text-center pt-3">
                                            <div class="p-4">
                                                <i class="fa fa-3x fa-calendar-alt text-primary mb-4"></i>
                                                <h5 class="mb-3">Appointment Booking</h5>
                                                <p>Effortlessly book your appointments online with the best salons.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="service-item text-center pt-3">
                                            <div class="p-4">
                                                <i class="fa fa-3x fa-tags text-primary mb-4"></i>
                                                <h5 class="mb-3">Price Inquiry</h5>
                                                <p>Get accurate information about prices and services offered at various salons.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="service-item text-center pt-3">
                                            <div class="p-4">
                                                <i class="fa fa-3x fa-star text-primary mb-4"></i>
                                                <h5 class="mb-3">Customer Reviews</h5>
                                                <p>Read reviews and ratings from customers about different salon services to help you choose.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Service End -->

                        {{-- <img src="https://media.istockphoto.com/id/652327300/photo/beautiful-girl-surrounded-by-hands-of-makeup-artists-with-brushes-and-lipstick-near-her-face.jpg?s=612x612&w=0&k=20&c=uPTRzhnN24QqsC5N_Y2WD5SB8u34udY9x7uhGlUfPXA=" --}}
                        <!-- Courses Start -->
                        <div class="container-xxl py-5">
                            <div class="container">

                                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                                    <h1 class="mb-5">the best salon</h1>
                                </div>
                                <div class="row g-4 justify-content-center">
                                    {{-- <a href="#"> --}}
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="course-item card-border">
                                            <div class="position-relatives overflow-hidden">
                                                <img class="img-fluid" src="https://i.pinimg.com/236x/fa/fc/58/fafc58eac041190778c3921fcf05de47.jpg" alt="" style="width:400px">
                                            </div>
                                            <div class="text-center p-4 pb-0" >
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    {{-- <small>(123)</small> --}}
                                                </div>
                                                <h3 class="h-card">mayar</h3>
                                                <h5 class="p-card">Web Design & Development Course for Beginners</h5>
                                            </div>

                                        </div>
                                    </div>
                                {{-- </a> --}}
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="course-item card-border">
                                            <div class="position-relatives overflow-hidden">
                                                <img class="img-fluid" src="https://i.pinimg.com/236x/fa/fc/58/fafc58eac041190778c3921fcf05de47.jpg" alt="" style="width:400px">
                                            </div>
                                            <div class="text-center p-4 pb-0" >
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                </div>
                                                <h3 class="h-card">mayar</h3>
                                                <h5 class="p-card">Web Design & Development Course for Beginners</h5>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="course-item card-border">
                                            <div class="position-relatives " >
                                                <img class="img-fluid" src="https://i.pinimg.com/236x/fa/fc/58/fafc58eac041190778c3921fcf05de47.jpg" alt="" style="width:400px">
                                            </div>
                                            <div class="text-center p-4 pb-0">
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                </div>
                                                <h3 class="h-card">mayar</h3>
                                                <h5 class="p-card">Web Design & Development Course for Beginners</h5>
                                                <a href="{{route('more_deteils')}}"><button>see more</button></a>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>
                        </div>
                        <!-- Courses End -->

                        <!-- About Start -->
                        <div class="container-xxl py-5">
                            <div class="container">
                                <div class="row g-5">
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                                        <div class="position-relative h-100">
                                            <img src="https://media.istockphoto.com/id/652327300/photo/beautiful-girl-surrounded-by-hands-of-makeup-artists-with-brushes-and-lipstick-near-her-face.jpg?s=612x612&w=0&k=20&c=uPTRzhnN24QqsC5N_Y2WD5SB8u34udY9x7uhGlUfPXA=" alt="" style="object-fit: cover; height: 100%; width: 100%;">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <h6 class="section-title bg-white text-start text-primary pe-3">About Beauty Connect</h6>
                                        <h1 class="mb-4">Welcome to Beauty Connect</h1>
                                        <p class="mb-4">Discover the finest salons and beauty services at your fingertips. Beauty Connect connects you with skilled professionals to enhance your beauty experience.</p>
                                        <p class="mb-4">Our platform offers seamless appointment booking and access to a variety of services, ensuring you find exactly what you need.</p>
                                        <div class="row gy-2 gx-4 mb-4">
                                            <div class="col-sm-6">
                                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Expert Stylists</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Easy Online Booking</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Transparent Pricing</p>
                                            </div>
                                            <div class="col-sm-6">
                                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Customer Reviews</p>
                                            </div>
                                        </div>
                                        <a class="btn btn-primary py-3 px-5 mt-2" href="">Learn More</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- About End -->


                        <!-- Categories Start -->
                        {{-- <div class="container-xxl py-5 category">
                            <div class="container">
                                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                                    <h1 class="mb-5">Courses Categories</h1>
                                </div>
                                <div class="row g-3">
                                    <div class="col-lg-7 col-md-6">
                                        <div class="row g-3">
                                            <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                                                <a class="position-relative d-block overflow-hidden" href="">
                                                    <img class="img-fluid" src="img/cat-1.jpg" alt="">
                                                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                                        <h5 class="m-0">Web Design</h5>
                                                        <small class="text-primary">49 Courses</small>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                                                <a class="position-relative d-block overflow-hidden" href="">
                                                    <img class="img-fluid" src="img/cat-2.jpg" alt="">
                                                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                                        <h5 class="m-0">Graphic Design</h5>
                                                        <small class="text-primary">49 Courses</small>
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                                                <a class="position-relative d-block overflow-hidden" href="">
                                                    <img class="img-fluid" src="img/cat-3.jpg" alt="">
                                                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                                        <h5 class="m-0">Video Editing</h5>
                                                        <small class="text-primary">49 Courses</small>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                                        <a class="position-relative d-block h-100 overflow-hidden" href="">
                                            <img class="img-fluid position-absolute w-100 h-100" src="img/cat-4.jpg" alt="" style="object-fit: cover;">
                                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin:  1px;">
                                                <h5 class="m-0">Online Marketing</h5>
                                                <small class="text-primary">49 Courses</small>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Categories Start -->


                        <!-- Courses Start -->
                        {{-- <div class="container-xxl py-5">
                            <div class="container">
                                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                                    <h1 class="mb-5">Popular Courses</h1>
                                </div>
                                <div class="row g-4 justify-content-center">
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="course-item bg-light">
                                            <div class="position-relative overflow-hidden">
                                                <img class="img-fluid" src="img/course-1.jpg" alt="">
                                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4 pb-0">
                                                <h3 class="mb-0">$149.00</h3>
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small>(123)</small>
                                                </div>
                                                <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                                            </div>
                                            <div class="d-flex border-top">
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="course-item bg-light">
                                            <div class="position-relative overflow-hidden">
                                                <img class="img-fluid" src="img/course-2.jpg" alt="">
                                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4 pb-0">
                                                <h3 class="mb-0">$149.00</h3>
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small>(123)</small>
                                                </div>
                                                <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                                            </div>
                                            <div class="d-flex border-top">
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="course-item bg-light">
                                            <div class="position-relative overflow-hidden">
                                                <img class="img-fluid" src="img/course-3.jpg" alt="">
                                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4 pb-0">
                                                <h3 class="mb-0">$149.00</h3>
                                                <div class="mb-3">
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small class="fa fa-star text-primary"></small>
                                                    <small>(123)</small>
                                                </div>
                                                <h5 class="mb-4">Web Design & Development Course for Beginners</h5>
                                            </div>
                                            <div class="d-flex border-top">
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>John Doe</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>1.49 Hrs</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>30 Students</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Courses End -->


                        <!-- Team Start -->
                        {{-- <div class="container-xxl py-5">
                            <div class="container">
                                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                                    <h1 class="mb-5">Expert Instructors</h1>
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <div class="team-item bg-light">
                                            <div class="overflow-hidden">
                                                <img class="img-fluid" src="img/team-1.jpg" alt="">
                                            </div>
                                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4">
                                                <h5 class="mb-0">Instructor Name</h5>
                                                <small>Designation</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <div class="team-item bg-light">
                                            <div class="overflow-hidden">
                                                <img class="img-fluid" src="img/team-2.jpg" alt="">
                                            </div>
                                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4">
                                                <h5 class="mb-0">Instructor Name</h5>
                                                <small>Designation</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                        <div class="team-item bg-light">
                                            <div class="overflow-hidden">
                                                <img class="img-fluid" src="img/team-3.jpg" alt="">
                                            </div>
                                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4">
                                                <h5 class="mb-0">Instructor Name</h5>
                                                <small>Designation</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                                        <div class="team-item bg-light">
                                            <div class="overflow-hidden">
                                                <img class="img-fluid" src="img/team-4.jpg" alt="">
                                            </div>
                                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center p-4">
                                                <h5 class="mb-0">Instructor Name</h5>
                                                <small>Designation</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- Team End -->


                        <!-- Testimonial Start -->
                        <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="container">
                                <div class="text-center">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                                    <h1 class="mb-5">Our Students Say!</h1>
                                </div>
                                <div class="owl-carousel testimonial-carousel position-relative">
                                    <div class="testimonial-item text-center">
                                        <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-1.jpg" style="width: 80px; height: 80px;">
                                        <h5 class="mb-0">Client Name</h5>
                                        <p>Profession</p>
                                        <div class="testimonial-text bg-light text-center p-4">
                                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-item text-center">
                                        <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-2.jpg" style="width: 80px; height: 80px;">
                                        <h5 class="mb-0">Client Name</h5>
                                        <p>Profession</p>
                                        <div class="testimonial-text bg-light text-center p-4">
                                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-item text-center">
                                        <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-3.jpg" style="width: 80px; height: 80px;">
                                        <h5 class="mb-0">Client Name</h5>
                                        <p>Profession</p>
                                        <div class="testimonial-text bg-light text-center p-4">
                                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                                        </div>
                                    </div>
                                    <div class="testimonial-item text-center">
                                        <img class="border rounded-circle p-2 mx-auto mb-3" src="img/testimonial-4.jpg" style="width: 80px; height: 80px;">
                                        <h5 class="mb-0">Client Name</h5>
                                        <p>Profession</p>
                                        <div class="testimonial-text bg-light text-center p-4">
                                        <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Testimonial End -->
                           <!-- Contact Start -->
                           <div class="container-xxl py-5">
                            <div class="container">
                                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                                    <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                                    <h1 class="mb-5">Contact For Any Query</h1>
                                </div>
                                <div class="row g-4">
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                        <h5>Get In Touch</h5>
                                        <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                                                <i class="fa fa-map-marker-alt text-white"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="text-primary">Office</h5>
                                                <p class="mb-0">123 Street, New York, USA</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                                                <i class="fa fa-phone-alt text-white"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="text-primary">Mobile</h5>
                                                <p class="mb-0">+012 345 67890</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                                                <i class="fa fa-envelope-open text-white"></i>
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="text-primary">Email</h5>
                                                <p class="mb-0">info@example.com</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                        <iframe class="position-relative rounded w-100 h-100"
                                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                                            frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                                            tabindex="0"></iframe>
                                    </div>
                                    <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                                        <form>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="name" placeholder="Your Name">
                                                        <label for="name">Your Name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="email" class="form-control" id="email" placeholder="Your Email">
                                                        <label for="email">Your Email</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <input type="text" class="form-control" id="subject" placeholder="Subject">
                                                        <label for="subject">Subject</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating">
                                                        <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                                        <label for="message">Message</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Contact End -->
                    @endsection

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
