@extends('layouts.app-user')

@section('content')

<!-- Hero Section with Background Image and Overlay -->
<div class="hero-section">
    <!-- Overlay -->
    <div class="overlay"></div>

    <!-- Hero Content -->
    <div class="hero-content">
        <h1 class="text-white">The Salons</h1>
        <h2>Find Your Perfect Salon</h2>
    </div>

    <!-- Booking Filter Form -->
    <div class="filter-form">
        <form method="GET" action="{{ route('more_subsalons') }}" class="d-flex justify-content-center gap-4 w-100">
            <!-- Type Filter -->
            <select name="type" class="form-control" style="width: 200px;border-radius: 5px">
                <option value="">All Salons</option>
                <option value="women" {{ request('type') == 'women' ? 'selected' : '' }}>Women</option>
                <option value="men" {{ request('type') == 'men' ? 'selected' : '' }}>Men</option>
                <option value="mixed" {{ request('type') == 'mixed' ? 'selected' : '' }}>Mixed</option>
            </select>

            <!-- Governorate Filter -->
            <select name="governorate" class="form-control" style="width: 200px;border-radius: 5px">
                <option value="">All Governorates</option>
                @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                    <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                @endforeach
            </select>

            <!-- Salon Name Search -->
            <input type="text" name="name" class="form-control" placeholder="Search by Salon Name" value="{{ request('name') }}" style="width: 200px; border-radius: 5px">

            <!-- Filter Button -->
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>
</div>

<!-- Hero Section Styles -->
<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 500px;
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
        background: rgba(79, 79, 79, 0.671); /* فلتر داكن مع شفافية أقل */
        z-index: 1;
    }

    .filter-form {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px; /* تقليل الفراغ بين الحقول */
        position: relative;
        z-index: 2;
        margin-top: 10px; /* تقليل المسافة العلوية */
    }

    .filter-form select, .filter-form input {
        padding: 8px; /* تقليل الحشو داخل الحقول */
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px; /* تقليل حجم الخط داخل الحقول */
    }

    .filter-form button {
        padding: 10px 16px; /* تقليل حجم الزر */
        font-size: 14px; /* تقليل حجم النص في الزر */
        /* border-radius: 50px; */
        background-color: rgb(134, 134, 134);
        border-color: #484848;
        font-weight: 600;
    }

    .filter-form button:hover {
        background-color: #333333;
        border-color: #333333;
    }

    /* Booking Cards Section */
    .booking-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        align-items: flex-start; /* محاذاة النص لليسار */
    }

    .salon-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .countdown {
        font-weight: bold;
        color: #d9534f;
    }

    .no-booking-message {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh;
        font-size: 20px;
        color: #333;
        text-align: center;
    }

    .booking-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .card {
        display: flex;
        flex-direction: column;
        position: relative;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
        background-color: #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
        color: #555;
    }

    .type-card {
        position: absolute;
        top: 15px; /* تعديل الموضع ليكون أعلى الكارد */
        left: 15px; /* تحديد الموضع من اليسار */
        padding: 8px 15px;
        border-radius: 25px;
        color: white;
        font-weight: 600;
        text-transform: capitalize;
        background-color: #484848;
        z-index: 2;
    }

    /* Adjust Grid Layout */
    .card .salon-image {
        height: 180px;
        width: 100%;
        object-fit: cover;
    }

    /* Styling the button to match the filter button color */
    .btn-primary {
        background-color: #484848; /* نفس لون زر الفلتر */
        border-color: #484848;
    }

    .btn-primary:hover {
        background-color: #333333; /* نفس لون hover في زر الفلتر */
        border-color: #333333;
    }

</style>

<!-- Salon Listings Section -->
<div class="container mt-5">


    <!-- Separator -->
    <div class="salon-divider"></div>

    <!-- Display Salons -->
    <div id="salon-results" class="row">
        @forelse ($subsalons as $subsalon)
            <div class="col-md-6 col-lg-3 text-center mb-5">
                <!-- Card for Salon -->
                <div class="booking-card">
                    <!-- Salon Type Badge -->
                    {{-- <div class="type-card">
                        {{ ucfirst($subsalon->type) }}
                    </div> --}}

                    <!-- Salon Image -->
                    <img src="{{ $subsalon->salon->image }}" alt="Salon Image" class="salon-image">

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Location & Type Info -->
                        <p>
                            <i class="fas fa-map-marker-alt"></i> {{ $subsalon->location }} |
                            <i class="fas fa-user"></i> for {{ ucfirst($subsalon->type) }}
                        </p>

                        <!-- Salon Name -->
                        <h5 class="card-title">{{ $subsalon->salon->name }}</h5>

                        <!-- Salon Description -->
                        <p class="card-text">{{ Str::limit($subsalon->description, 100) }}</p>

                        <!-- See More Button -->
                        <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <img src="https://unsplash-assets.imgix.net/empty-states/photos.png" alt="No salons found" class="no-salons-image">
                <p class="no-salons-message">No salons found. But don't worry, there are many other amazing salons waiting for you!</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
