@extends('layouts.app-user')

@section('content')
    <section class="inner-page">
        <div class="slider-item py-5"
            style="background-image: url('img/slider-2.jpg'); background-size: cover; background-position: center;">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text align-items-center justify-content-center text-center">
                    <div class="col-md-7 col-sm-12">
                        <h1 class="text-white">Welcome to Your Profile</h1>
                        <h2 class="text-white">Manage your personal details and bookings with ease</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Section (Top) -->
    <div class="profile-filter-section py-5">
        <div class="container">
            <div class="row">
                <!-- User Profile -->
                <div class="col-md-12">
                    <h3 class="text-center mb-4">User Profile</h3>
                    <div class="profile-section">
                        <div class="user-info text-center">
                            <div class="profile-image mb-3">
                                <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : 'https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg' }}"
                                     alt="Profile Image"
                                     class="img-fluid"
                                     style="margin-top:40px; width: 150px; height: 150px; border-radius: 50%; border: 2px solid #616161; object-fit: cover;">
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
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#editProfileModal">Edit Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bookings Section (Bottom) -->
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="text-center mb-4">Your Available Bookings</h3>
                <form method="GET" action="{{ route('my_booking') }}">
                    <!-- Optional: Add filters here -->
                </form>

                @if ($userBookings->isEmpty())
                    <div class="no-booking-message text-center mt-5">
                        <img src="https://unsplash-assets.imgix.net/empty-states/photos.png?auto=format&fit=crop&q=60"
                             alt="No bookings" class="img-fluid" style="max-width: 250px;">
                        <p>No available bookings at the moment.</p>
                    </div>
                @else
                    <div class="booking-grid row mt-4">
                        @foreach ($userBookings as $booking)
                            @php
                                $bookingTime = \Carbon\Carbon::parse($booking->time);
                                $currentTime = \Carbon\Carbon::now();
                                $isExpired = $bookingTime->isPast();
                            @endphp

                            @if (!$isExpired)
                                <div class="col-md-6 mb-4">
                                    <div class="booking-card border rounded p-3 shadow-sm">
                                        <img src="{{ $booking->subSalon->salon->image }}" alt="Salon Image"
                                             class="salon-image mb-3 w-100">
                                        <h5>{{ $booking->subSalon->salon->name }}</h5>
                                        <p>Date: {{ htmlspecialchars($booking->date) }}</p>
                                        <p>Time: {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>
                                        <p class="booking-status">
                                            @if ($isExpired)
                                                <span class="text-danger">This booking has expired.</span>
                                            @else
                                                <span class="text-success">This booking is still active.</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal for Editing Profile -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update_profile_user') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ auth()->user()->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ auth()->user()->email }}" required>
                        </div>

                        <!-- Profile Image (Optional) -->
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="image">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password (Leave empty to keep the current password)</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<!-- Custom Styles -->
<style>
    .profile-filter-section {
        background-color: #f9f9f9;
    }

    .profile-section {
        background-color: #ffffff;
        border: 1px solid #e1e1e1;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
    }

    .user-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .user-info .form-group p {
        color: #555;
    }

    .booking-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .booking-card:hover {
        transform: translateY(-5px);
    }

    .booking-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .countdown {
        font-size: 16px;
        color: #ff6600;
    }

    @media (max-width: 768px) {
        .profile-filter-section {
            padding: 20px;
        }

        .profile-section {
            max-width: 100%;
        }

        .booking-grid {
            flex-direction: column;
        }
    }
</style>