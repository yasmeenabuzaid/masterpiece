@extends('layouts.app-user')

@section('content')

<!-- Hero Section Styles -->
<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 300px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background-image: url('{{ asset('salon-landing.png') }}');
        background-size: cover;
        background-position: center;
    }

    .hero-content {
        text-align: center;
        color: #fff;
        z-index: 2;
        padding: 10px;
    }

    .hero-section h1 {
        font-size: 58px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .hero-section h2 {
        font-size: 24px;
        font-weight: 500;
    }

    /* Overlay over Hero Section */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(79, 79, 79, 0.671); /* Dark overlay */
        z-index: 1;
    }

    /* Filter Form Styles */
    .filter-form {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .filter-form select,
    .filter-form input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 200px;
        transition: all 0.3s ease;
    }

    .filter-form select:focus,
    .filter-form input:focus {
        border-color: #007bff;
        outline: none;
    }

    .filter-form button {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-form button:hover {
        background-color: #0056b3;
    }

    .btn-group .btn {
        margin: 5px;
        border-radius: 5px;
        padding: 10px 20px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        font-size: 14px;
        color: #333;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-group .btn:hover,
    .btn-group .btn.active {
        background-color: #007bff;
        color: #fff;
    }

    .media img {
        width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
    }

    .media-body {
        padding: 10px;
    }
</style>

<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center element-animate">
            <div class="col-md-8 text-center ">
                <h2 class="text-uppercase heading border-bottom mb-4">Our News</h2>
                <p class="mb-0 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
            </div>
        </div>

        <!-- Filter Form Section -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="filter-form">
                    <form method="GET" action="{{ route('more_subsalons') }}" class="d-flex justify-content-between w-100 gap-3">
                        <!-- Type Filter -->
                        <div class="btn-group" role="group" aria-label="Salon Type Filter">
                            <button type="submit" name="type" value="" class="btn {{ request('type') == '' ? 'active' : '' }}">All Salons</button>
                            <button type="submit" name="type" value="women" class="btn {{ request('type') == 'women' ? 'active' : '' }}">Women</button>
                            <button type="submit" name="type" value="men" class="btn {{ request('type') == 'men' ? 'active' : '' }}">Men</button>
                            <button type="submit" name="type" value="mixed" class="btn {{ request('type') == 'mixed' ? 'active' : '' }}">Mixed</button>
                        </div>

                        <!-- Governorate Filter -->
                        <select name="governorate" class="btn">
                            <option value="">All Governorates</option>
                            @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                                <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                            @endforeach
                        </select>

                        <!-- Salon Name Search -->
                        <input type="text" name="name" class="btn " placeholder="Search by Salon Name" value="{{ request('name') }}">

                        <!-- Filter Button -->
                        <button type="submit" class="btn">Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Carousel for News -->
        <div class="row element-animate">
            @forelse ($subsalons->chunk(4) as $chunkedSubsalons) <!-- تقسيم الصالونات إلى مجموعات من 4 -->
                <div class="row">
                    @foreach ($chunkedSubsalons as $subsalon) <!-- عرض كل صالون في العمود -->
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="media d-block media-custom text-left">
                                <img src="{{ $subsalon->salon->image }}" alt="Image Placeholder" class="img-fluid" style="width: 100%; height: 200px; object-fit: cover;">
                                <div class="media-body">
                                    <span class="meta-post">December 2, 2017</span>
                                    <h3 class="mt-0 text-black"><a href="#" class="text-black">{{ $subsalon->salon->name }}</a></h3>
                                    <p>{{ Str::limit($subsalon->description, 100) }}</p>
                                    <p class="clearfix">
                                        <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                                        <a href="#" class="float-right meta-chat"><span class="ion-chatbubble"></span> 8</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="col-12 text-center d-flex justify-content-center align-items-center" style="height: 300px; margin-top: 40px;">
                    <div class="no-salons-content">
                        <img src="https://unsplash-assets.imgix.net/empty-states/photos.png" alt="No salons found" class="no-salons-image" style="max-width: 50%; height: auto;">
                        <p class="no-salons-message" style="font-size: 18px; color: #666;">No salons found. But don't worry, there are many other amazing salons waiting for you!</p>
                    </div>
                </div>
            @endforelse
        </div>

    </section>

@endsection
