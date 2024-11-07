@extends('layouts.app-user')

@section('content')
<style>
    .salon-slider .item {
        margin: 10px;
    }

    .card {
        display: flex;
        align-items: flex-start;
        position: relative;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
    }

    .type-card {
        position: absolute;
        right: 10px;
        top: 10px;
        padding: 5px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        z-index: 10;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        text-transform: capitalize;
    }

    .salon-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
    }

    .mb-10 {
        margin-bottom: 20px;
    }

    /* تعديل محاذاة النص إلى اليسار */
    .card-body {
        text-align: left; /* التأكد من أن النص محاذي لليسار */
    }

    .card-title,
    .card-text {
        text-align: left;
    }

    .card p {
        text-align: left;
    }
    .btn-primary {
        background-color: #484848; /* تغيير لون الخلفية */
        border-color: #484848; /* تغيير لون الحدود */
    }

    .btn-primary:hover {
        background-color: #333333; /* تغيير اللون عند المرور فوق الزر */
        border-color: #333333; /* تغيير اللون عند المرور فوق الزر */
    }
</style>

<div class="container">
    <div class="text-center wow fadeInUp mb-10 mt-5" data-wow-delay="0.1s">
        <h2 class="site-section-heading font-weight-light ">the Salons</h2>
    </div>

    <div class="container mb-4">
        <form id="filter-form" method="GET" action="{{ route('more_subsalons') }}" class="mb-4">
            <div class="row align-items-center">
                <div class="col-md-3 mb-3">
                    <select name="type" class="form-control" id="type-filter">
                        <option value="">Choose Salon Type</option>
                        <option value="women" {{ request('type') == 'women' ? 'selected' : '' }}>Women</option>
                        <option value="men" {{ request('type') == 'men' ? 'selected' : '' }}>Men</option>
                        <option value="mixed" {{ request('type') == 'mixed' ? 'selected' : '' }}>Mixed</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="governorate" class="form-control" id="governorate-filter">
                        <option value="">Choose Governorate</option>
                        @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                            <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <input type="text" name="name" class="form-control" id="name-filter" placeholder="Search by Salon Name" value="{{ request('name') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <div id="salon-results" class="row">
        @foreach ($subsalons as $subsalon)
            <div class="col-md-6 col-lg-3 text-center mb-5">
                <div class="card h-100 bg-light">
                    <img src="{{ $subsalon->salon->image }}" alt="Image" class="salon-image">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <p>
                                    <i class="fas fa-map-marker-alt"></i> {{ $subsalon->location }} |
                                    <i class="fas fa-user"></i> for {{ $subsalon->type }}
                                </p>
                                <h5 class="card-title">{{ $subsalon->salon->name }}</h5>
                                <div class="type-card" style="background-color: #dadada;color:rgb(0, 0, 0)">
                                    {{ $subsalon->type === 'women' ? ' women' : ($subsalon->type === 'men' ? ' men' : 'mixed') }}
                                </div>

                                <p class="card-text">{{ Str::limit($subsalon->description, 100) }}</p>
                                <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                            </div>
                        </div>
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
