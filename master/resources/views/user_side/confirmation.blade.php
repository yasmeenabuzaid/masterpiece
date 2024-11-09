@extends('layouts.app-user')

@section('content')
<!-- Hero Section with a Single Image -->
<div class="hero-section">
    <!-- Overlay (فلتر أسود خفيف) -->
    <div class="overlay"></div>

    <div class="hero-content">
        <h1 class="text-white">Your Booking</h1>
        <h2>Welcome to Salonak</h2>
    </div>

    <!-- Booking Filter Form (وضع الفلتر تحت النص داخل قسم الهيرو) -->
    <div class="filter-form">
        <form method="GET" action="{{ route('my_booking') }}">
            <!-- Time Filter -->
            <select name="order_by">
                <option value="newest" {{ request('order_by') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="oldest" {{ request('order_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
            </select>

            <!-- Search by Salon Name -->
            <input type="text" name="salon_name" placeholder="Search by Salon Name" value="{{ request('salon_name') }}">

            <button type="submit" class="btn">Filter</button>
        </form>
    </div>

    <div class="hero-image" style="background-image: url('{{ asset('salon-landing.png') }}');"></div>
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
    }

    .hero-content {
        text-align: center;
        color: #fff;
        z-index: 2;
        padding: 10px;
    }

    .hero-section h1 {
        font-size: 46px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .hero-section h2 {
        font-size: 24px;
        font-weight: 500;
    }

    /* Hero Image */
    .hero-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 1;
        z-index: 0;
    }

    /* Overlay over Hero Section */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(79, 79, 79, 0.48); /* فلتر داكن مع شفافية أقل */
        z-index: 1;
    }

    /* Filters */
    .filter-form {
        display: flex;
        justify-content: center;
        gap: 10px; /* تقليل المسافة بين الحقول */
        margin-top: 15px; /* تقليل المسافة بين الفلتر والنص */
        z-index: 2;
        position: relative;
    }

    .filter-form select, .filter-form input {
        width: 200px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .filter-form button {
        background-color: #6c6c6c;
        color: white;
        padding: 8px 16px;
        border: none;
        cursor: pointer;
        font-size: 14px;
        border-radius: 50px;
    }

    .filter-form button:hover {
        background-color: #808080;
        color: white;
    }

    /* Bookings Section */
    .booking-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* عرض حجزين في كل صف */
        gap: 20px; /* المسافة بين العناصر */
        padding: 20px;
        margin: 40px; /* زيادة المسافة بين الهيرو سكشن وبقية المحتوى */
    }

    .booking-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: row;
        /* إزالة تأثير الـ hover */
        transition: none;
    }

    .booking-card img {
        width: 120px;  /* تحديد عرض الصورة */
        height: 120px; /* تحديد ارتفاع الصورة */
        object-fit: cover;
        border-right: 2px solid #ddd;
        margin: 10px;
    }

    /* Content on the right */
    .booking-card .content {
        padding: 15px;
        flex-grow: 1;
    }

    .booking-card h5 {
        font-size: 18px;
        color: #333;
        margin: 0;
    }

    .booking-card p {
        font-size: 14px;
        color: #666;
    }

    .countdown {
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        color: #e74c3c;
        background-color: #f9f9f9;
        margin-top: 10px;
        text-align: center;
    }

    /* No Booking Message */
    .no-booking-message {
        text-align: center;
        font-size: 18px;
        color: #333;
        margin-top: 30px;
    }

    /* Booking Status Styles */
    .booking-status {
        font-weight: bold;
        font-size: 14px;
        margin-top: 10px;
    }

    .expired {
        color: #e74c3c; /* Red color for expired bookings */
    }

    .active {
        color: #2ecc71; /* Green color for active bookings */
    }

    /* For small screens */
    @media (max-width: 768px) {
        .hero-section h1 {
            font-size: 28px;
        }

        .hero-section h2 {
            font-size: 18px;
        }

        .booking-grid {
            grid-template-columns: 1fr; /* عرض حجز واحد في كل صف على الشاشات الصغيرة */
        }

        .filter-form select, .filter-form input {
            width: 150px;
        }
    }
    .containe{
        margin: 30px;
    }
</style>

<!-- Display User Bookings -->
@if($userBookings->isEmpty())
    <div class="no-booking-message">
        <p>No bookings available at the moment.</p>
    </div>
@else
    <div class="booking-grid">
        @foreach($userBookings as $booking)
            @php
                // Convert booking time to Carbon instance
                $bookingTime = \Carbon\Carbon::parse($booking->time);
                $currentTime = \Carbon\Carbon::now();
                $isExpired = $bookingTime->isPast(); // Check if the booking has expired
            @endphp
            <div class="booking-card">
                <!-- Salon Image -->
                <img src="{{ $booking->subalon->salon->image }}" alt="Salon Image" class="salon-image">

                <div class="content">
                    <h5>{{ $booking->subalon->salon->name }}</h5>
                    <p>Date: {{ htmlspecialchars($booking->date) }}</p>
                    <p>Time: {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>

                    <!-- Booking Status -->
                    <p class="booking-status">
                        @if($isExpired)
                            <span class="expired">This booking has expired.</span>
                        @else
                            <span class="active">This booking is still active.</span>
                        @endif
                    </p>

                    <div class="countdown" id="countdown-{{ $booking->id }}" aria-live="polite"></div>
                </div>
            </div>
        @endforeach
    </div>
@endif

<script>
    $(document).ready(function(){
        $("#hero-sec").owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            nav: true,
            dots: false
        });
    });
    // Automatically close the alert after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.display = 'none';
        });
    }, 5000); // 5000ms = 5 seconds
</script>

@endsection
