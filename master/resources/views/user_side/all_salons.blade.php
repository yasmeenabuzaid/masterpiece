@extends('layouts.app-user')

@section('content')
   {{-- <div class="container-xxl py-5"> --}}
            {{-- <div class="container"> --}}
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            <h1 class="mb-5">Popular Courses</h1>
        </div>
        <div class="container-xxl ">
            <div class="container">
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
                <div class="row g-4">
                    @foreach ($subsalons->slice(0, 4) as $subsalon)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="{{ 0.1 + (0.2 * $loop->index) }}s">
                            <div class="team-item bg-light">
                                <div class="overflow-hidden">
                                    <img class="img-fluid" src="{{ asset($subsalon->image) }}" alt="{{ $subsalon->name }}">
                                </div>
                                <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                    {{-- Optional social links can go here --}}
                                </div>
                                <div class="text-center p-4">
                                    <div class="mb-3">
                                        @for ($i = 0; $i < 5; $i++)
                                            <small class="fa fa-star" style="color: rgb(197, 175, 50);"></small>
                                        @endfor
                                    </div>
                                    <h5 class="mb-0">{{ $subsalon->name }}</h5>
                                    <small>{{ $subsalon->description }}</small>
                                    <a href="{{ route('single_salon', $subsalon) }}">
                                    <button>see more</button>
                                </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(isset($subsalons))
                <div class="row g-4">
                    @foreach ($subsalons->slice(0, 4) as $subsalon)
                        <!-- عرض البيانات هنا -->
                    @endforeach
                </div>
            @else
                <p>No sub-salons found.</p>
            @endif



                </div>
            </div>
        </div>
                        </div>

                        </div>
                    </div>
                        </div>

                        </div>


@endsection
