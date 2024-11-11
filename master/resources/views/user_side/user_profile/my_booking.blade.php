@extends('layouts.app-user')

@section('content')

<div class="hero-section">
    <div class="overlay"></div>
    <div class="hero-content">
        <h1>Welcome to Your Profile</h1>
        <h2>Manage your personal details and bookings with ease</h2>
    </div>
</div>

<div class="profile-filter-section">
    <div class="container">
        <div class="profile-section">
            <h2>User Profile</h2>
            <div class="user-info">
                <div class="profile-image">
                    <img src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg') }}" alt="Profile Image">
                </div>

                <div class="user-details">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <p>{{ auth()->user()->name }}</p>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <p>{{ auth()->user()->email }}</p>
                    </div>

                    <div class="form-group">
                        <label for="usertype">User Type</label>
                        <p>{{ auth()->user()->usertype }}</p>
                    </div>

                    <div class="form-group mt-3">
                        <a href="" class="btn btn-primary">Edit Profile</a>
                        <a href="{{ route('my_booking') }}" class="btn btn-secondary">Your Past Bookings</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-section">
            <form method="GET" action="{{ route('my_booking') }}">
                <h3>Your Available Bookings</h3>
                <div class="filter-form">
                    <div class="filter-select">
                        <select name="order_by">
                            <option value="newest" {{ request('order_by') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('order_by') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>
                    </div>
                    <div class="filter-input">
                        <input type="text" name="salon_name" placeholder="Search by Salon Name" value="{{ request('salon_name') }}">
                    </div>
                    <div class="filter-button">
                        <button type="submit" class="btn">Filter</button>
                    </div>
                </div>
            </form>

            @if($userBookings->isEmpty())
            <div class="no-booking-message text-center">
                <img src="https://unsplash-assets.imgix.net/empty-states/photos.png?auto=format&fit=crop&q=60" alt="No bookings" style="width: 250px; height: auto; margin-top: 0px;">
                <p>No bookings available at the moment.</p>
            </div>
            @else
                <div class="booking-grid">
                    @foreach($userBookings as $booking)
                        @php
                            $bookingTime = \Carbon\Carbon::parse($booking->time);
                            $currentTime = \Carbon\Carbon::now();
                            $isExpired = $bookingTime->isPast();
                        @endphp
                        <div class="booking-card">
                            <img src="{{ $booking->subalon->salon->image }}" alt="Salon Image" class="salon-image">
                            <div class="content">
                                <h5>{{ $booking->subalon->salon->name }}</h5>
                                <p>Date: {{ htmlspecialchars($booking->date) }}</p>
                                <p>Time: {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>

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
        </div>
    </div>
</div>

<script>
    // Automatically close the alert after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(alert) {
            alert.style.display = 'none';
        });
    }, 5000); // 5000ms = 5 seconds
</script>

@endsection

<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        background-image: url('{{ asset('salon-landing.png') }}');
        background-size: cover;
        background-position: center;
        z-index: 1;
    }

    .hero-content {
        text-align: center;
        color: #fff;
        z-index: 2;
        padding: 10px;
        animation: fadeIn 1.5s ease-in-out;
    }

    .hero-section h1 {
        font-size: 52px;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .hero-section h2 {
        font-size: 26px;
        font-weight: 500;
    }

    /* Overlay */
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    /* Profile and Filter Section Styles */
    .profile-filter-section {
        display: flex;
        justify-content: space-between;
        gap: 40px;
        padding: 50px 0;
        position: relative;
        z-index: 2;
    }

    .profile-section, .filter-section {
        flex: 1;
    }

    .profile-section h2, .filter-section h3 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 28px;
    }

    .container {
        display: flex;
        justify-content: space-between;
        gap: 30px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .user-info {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;

    }
    .profile-section{
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        border: 1px solid #e1e1e1;
    }
    .profile-image img {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #ddd;
         justify-content: center;
    }

    .user-details p {
        margin: 8px 0;
        color: #555;
    }

    .filter-form {
        display: flex;
        gap: 15px;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
    }

    .filter-form select, .filter-form input, .filter-form button {
        padding: 12px;
        font-size: 16px;
        /* border-radius: 30px; */
        border: 1px solid #ddd;
        transition: all 0.3s ease-in-out;
    }

    .filter-form select:focus, .filter-form input:focus, .filter-form button:focus {
        border-color: #007bff;
        outline: none;
    }

    .filter-button button {
        background-color: #007bff;
        color: white;
        padding: 12px 25px;
        border: none;
        /* border-radius: 30px; */
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-button button:hover {
        background-color: #0056b3;
    }

    /* Booking Grid Styles */
    .booking-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        padding: 30px;
    }

    .booking-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        display: flex;
        flex-direction: row;
        padding: 15px;
        border: 1px solid #f1f1f1;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    .booking-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 10px;
        margin-right: 20px;
    }

    .booking-card .content {
        flex-grow: 1;
    }

    .booking-card h5 {
        font-size: 20px;
        margin-bottom: 10px;
        color: #333;
    }

    .booking-card p {
        font-size: 14px;
        color: #777;
    }

    .booking-status {
        font-weight: bold;
        font-size: 14px;
        margin-top: 10px;
    }

    .expired {
        color: #e74c3c;
    }

    .active {
        color: #2ecc71;
    }

    /* Countdown */
    .countdown {
        padding: 10px 15px;
        font-size: 16px;
        font-weight: bold;
        color: #e74c3c;
        background-color: #f9f9f9;
        margin-top: 10px;
        text-align: center;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .profile-filter-section {
            flex-direction: column;
        }

        .booking-grid {
            grid-template-columns: 1fr;
        }

        .filter-form select, .filter-form input {
            width: 100%;
            margin-bottom: 10px;
        }

        .filter-form button {
            width: 100%;
        }

        .hero-section h1 {
            font-size: 40px;
        }

        .hero-section h2 {
            font-size: 22px;
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>
