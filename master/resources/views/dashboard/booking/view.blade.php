@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
@extends('layouts.dashboard_master')

@section('content')

<div class="container-fluid p-0  " >
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 mt-1">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img src="{{ asset($subsalon->image) }}" alt="" style="object-fit: cover; height: 500px; width: 100%;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    {{-- <h6 class="section-title bg-white text-start text-primary pe-3">About Glamour Salon</h6> --}}
                    <h1 class="mb-4">Welcome to {{ ($subsalon->name) }} salon</h1>
                    <p class="mb-4">{{ ($subsalon->description) }}</p>
                    <p class="mb-4">Our platform offers seamless appointment booking and access to a variety of services, ensuring you find exactly what you need. We pride ourselves on delivering exceptional customer service and high-quality treatments.</p>

                    <h6 class="mt-4">Business Hours:</h6>
                    <p class="mb-4">Monday to Friday: 9 AM - 8 PM<br>Saturday: 10 AM - 6 PM<br>Sunday: Closed</p>

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
                </div>

                    {{-- <a class="btn btn-primary py-3 px-5 mt-2" href="">Learn More</a> --}}
                </div>
            </div>
        </div>
    </div>












@endsection
@endif
