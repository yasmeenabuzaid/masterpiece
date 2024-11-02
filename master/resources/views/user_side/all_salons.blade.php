@extends('layouts.app-user')

@section('content')
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h2 class="site-section-heading font-weight-light text-black text-center">Featured Salons</h2>
        </div>

        <div class="container mb-4">
            <form id="filter-form" method="GET" action="{{ route('more_subsalons') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-3">
                        <select name="type" class="form-control" id="type-filter">
                            <option value="">Choose Salon Type</option>
                            <option value="women" {{ request('type') == 'women' ? 'selected' : '' }}>Women</option>
                            <option value="men" {{ request('type') == 'men' ? 'selected' : '' }}>Men</option>
                            <option value="mixed" {{ request('type') == 'mixed' ? 'selected' : '' }}>Mixed</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="governorate" class="form-control" id="governorate-filter">
                            <option value="">Choose Governorate</option>
                            @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                                <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="name" class="form-control" id="name-filter" placeholder="Search by Salon Name" value="{{ request('name') }}">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <div id="salon-results" class="row">
            @foreach ($subsalons as $subsalon)
                <div class="col-md-6 col-lg-3 text-center mb-5">
                    <div class="h-70 bg-light site-block-feature-7">
                        <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid" style="width: 100%; height: 300px; object-fit: cover;">
                        <div class="p-3">
                            <h3 class="h4">{{ $subsalon->name }}</h3>
                            <p>At Glamour Touch Salon, we offer you a unique experience in beauty care.</p>
                            <a href="{{ route('single_salon', $subsalon) }}">
                                <button class="font-weight-bold">See More</button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if ($subsalons->isEmpty())
                <p>No sub-salons found.</p>
            @endif
        </div>
    </div>
@endsection
