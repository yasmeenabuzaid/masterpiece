@extends('layouts.app-user')

@section('content')
    <div class="container  ">
        <div class="text-center wow fadeInUp " data-wow-delay="0.1s">
            <br>
            <br>
            <h6 class="section-title  text-center  ">Courses</h6>
            <h1 class="mb-5  ">Popular Courses</h1>
        </div>
        <div class="container-xxl  bg-white">
            <div class="container">
                <div class="row mb-4 justify-content-center">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <a href="#" class="btn  w-100">Web Design</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <a href="#" class="btn w-100">Development</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <a href="#" class="btn  w-100">Marketing</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <a href="#" class="btn  w-100">Graphic Design</a>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                        <a href="#" class="btn w-100">Photography</a>
                    </div>
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </div> <!-- /.container-xxl -->
    </div> <!-- /.container -->
    </div> <!-- /.container-xxl -->


    </div> <!-- /.container -->
    </div> <!-- /.site-section -->
    <div class="site-section  bg-white">
        <div class="container  bg-white">

            <div class="row">
                @foreach ($subsalons->slice(0, 4) as $subsalon)
                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-70 bg-light site-block-feature-7">
                            <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid"
                                style="width: 400px; height: 300px; object-fit: cover;">
                            <div class="p-3 ">
                                <h3 class=" h4 text-primary">{{ $subsalon->name }}</h3>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id
                                    dolorum debitis.</p>
                                <a href="{{ route('single_salon', $subsalon) }}">
                                    <button class="font-weight-bold text-primary">See More</button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($subsalons->isEmpty())
                    <p>No sub-salons found.</p>
                @endif
                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-100 bg-light site-block-feature-7">
                        <img src="images/img_2.jpg" alt="Image" class="img-fluid">
                        <div class="p-4 p-lg-5">
                            <h3 class="text-black h4">Hair Cut Style Title Here</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id dolorum
                                debitis.</p>
                            <p><strong class="font-weight-bold text-primary">$29</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-100 bg-light site-block-feature-7">
                        <img src="images/img_3.jpg" alt="Image" class="img-fluid">
                        <div class="p-4 p-lg-5">
                            <h3 class="text-black h4">Hair Cut Style Title Here</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id dolorum
                                debitis.</p>
                            <p><strong class="font-weight-bold text-primary">$29</strong></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-100 bg-light site-block-feature-7">
                        <img src="images/img_4.jpg" alt="Image" class="img-fluid">
                        <div class="p-4 p-lg-5">
                            <h3 class="text-black h4">Hair Cut Style Title Here</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id dolorum
                                debitis.</p>
                            <p><strong class="font-weight-bold text-primary">$29</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-100 bg-light site-block-feature-7">
                        <img src="images/img_5.jpg" alt="Image" class="img-fluid">
                        <div class="p-4 p-lg-5">
                            <h3 class="text-black h4">Hair Cut Style Title Here</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id dolorum
                                debitis.</p>
                            <p><strong class="font-weight-bold text-primary">$29</strong></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
                    <div class="h-100 bg-light site-block-feature-7">
                        <img src="images/img_1.jpg" alt="Image" class="img-fluid">
                        <div class="p-4 p-lg-5">
                            <h3 class="text-black h4">Hair Cut Style Title Here</h3>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum exercitationem quae id dolorum
                                debitis.</p>
                            <p><strong class="font-weight-bold text-primary">$29</strong></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
