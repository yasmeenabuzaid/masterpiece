@extends('layouts.app-user')

@section('content')
    <div class="container  ">
        <div class="text-center wow fadeInUp " data-wow-delay="0.1s">

            <div class="site-section">
                <div class="container">
                    <div class="row justify-content-center mb-5">
                        <div class="col-md-z">
                            <h2 class="site-section-heading font-weight-light text-black text-center">Featured salons</h2>
                    </div>
                </div>

                <div class="container mb-4">
                    <form method="GET" action="{{ route('salons.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="type" class="form-control">
                                    <option value="">Choose Salon Type</option>
                                    <option value="women">Women</option>
                                    <option value="men">Men</option>
                                    <option value="mixed">Mixed</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="location" class="form-control" placeholder="Enter Location">
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="name" class="form-control" placeholder="Search by Salon Name">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Filter</button>
                    </form>
                </div>

            </div> <!-- /.container -->
        </div> <!-- /.container-xxl -->
    </div> <!-- /.container -->
    </div> <!-- /.container-xxl -->


    </div> <!-- /.container -->

        <div class="container  bg-white">

            {{-- <div class="row">
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
                @endif --}}

                    @php
                    $count = $subsalons->count();
                @endphp

                <div class="row">
                    @if ($count === 1)
                        @for ($i = 0; $i < 8; $i++)
                            <div class="col-md-6 col-lg-3 text-center mb-5">
                                <div class="h-70 bg-light site-block-feature-7">
                                    <img src="{{ $subsalons->first()->salon->image }}" alt="Image" class="img-fluid"
                                         style="width: 100%; height: 300px; object-fit: cover;">
                                    <div class="p-3 ">
                                        <h3 class="h4">{{ $subsalons->first()->name }}</h3>
                                        <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                                        <a href="{{ route('single_salon', $subsalons->first()) }}">
                                            <button class="font-weight-bold">See More</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @else
                        @foreach ($subsalons->slice(0, 8) as $subsalon)
                            <div class="col-md-6 col-lg-3 text-center mb-5">
                                <div class="h-70 bg-light site-block-feature-7">
                                    <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid"
                                         style="width: 100%; height: 300px; object-fit: cover;">
                                    <div class="p-3 ">
                                        <h3 class="h4">{{ $subsalon->name }}</h3>
                                        <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                                        <a href="{{ route('single_salon', $subsalon) }}">
                                            <button class="font-weight-bold">See More</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                </div>
                </div>
                </div>
@endsection
