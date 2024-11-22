@extends('layouts.app-user')

@section('content')
<section class="inner-page">
    <div class="slider-item py-5" style="position: relative; background-image: url('https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-7 col-sm-12 element-animate">
                    <h1 class="text-white">Your Profile</h1>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Profile and Bookings Section -->
<div class="container py-5">
    <div class="row">
        <!-- Profile Section (Left) -->
        <div class="col-md-6 mb-4">
            <div class="profile-filter-section py-5">
                <div class="user-details text-start">
                    <!-- Profile Image (Centered) -->
                    <div class="profile-image text-center mb-4">
                        <img src="{{ auth()->user()->image ? asset(auth()->user()->image) : 'https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg' }} "
                             alt="Profile Image"
                             class="img-fluid rounded-circle"
                             style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <!-- Full Name -->
                    <div class="form-group mb-3">
                        <label for="name" class="font-weight-bold">Your Full Name</label>
                        <p class="text-muted">{{ auth()->user()->name }}</p>
                    </div>
                    <hr>

                    <!-- Email -->
                    <div class="form-group mb-3">
                        <label for="email" class="font-weight-bold">Email Address</label>
                        <p class="text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <hr>

                    <!-- User Type -->
                    <div class="form-group mb-3">
                        <label for="usertype" class="font-weight-bold">Account Type</label>
                        <p class="text-muted">{{ auth()->user()->usertype }}</p>
                    </div>

                    <!-- Edit Profile Button -->
                    <div class="form-group mt-4">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Your Profile</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bookings Section (Right) -->
        <div class="col-md-6">
            <h3 class="text-center mb-4">Your Bookings</h3>
             <br>
            @if ($userBookings->isEmpty())
                <div class="no-booking-message text-center mt-5">
                    <img src="https://unsplash-assets.imgix.net/empty-states/photos.png?auto=format&fit=crop&q=60" alt="No bookings" class="img-fluid" style="max-width: 250px;">
                    <p>No bookings found.</p>
                </div>
            @else
                <!-- Timeline for Bookings -->
                <div class="timeline">
                    @foreach ($userBookings as $booking)
                    @php
                        $bookingDateTime = \Carbon\Carbon::parse($booking->date . ' ' . $booking->time);
                        $isExpired = $bookingDateTime->isPast();
                    @endphp
                    <div class="timeline-item">
                        <div class="timeline-icon {{ $isExpired ? 'bg-danger' : 'bg-success' }}"></div>
                        <div class="timeline-content">
                            <h5>{{ $booking->subSalon->salon->name }}</h5>
                            <p>Date: {{ $booking->date }}  </p>
                            <p>Time: {{ \Carbon\Carbon::parse($booking->time)->format('H:i') }}</p>
                            <p class="booking-status">
                                @if ($isExpired)
                                    <span class="text-danger">Expired</span>
                                @else
                                    <span class="text-success">Active</span>
                                @endif
                            </p>

                            <!-- Countdown Timer -->
                            @if (!$isExpired)
                            {{-- <p id="countdown-{{ $booking->id }}" class="text-primary">Time Left: <span id="countdown-text-{{ $booking->id }}">Loading...</span></p> --}}
                            <hr>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom Styles for Timeline -->
<style>
    .timeline {
        position: relative;
        padding-left: 30px;
        margin-left: 30px;
        border-left: 2px solid #ddd;
    }
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    .timeline-icon {
        position: absolute;
        left: -10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #0d6efd;
    }
    .timeline-content {
        padding-left: 30px;
    }

    .profile-filter-section {
        background-color: #f9f9f9;
    }

    .profile-image {
        margin-bottom: 10px;
    }

    .user-details {
        margin-top: 0;
    }

    .booking-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        padding: 10px;
        transition: transform 0.3s ease-in-out;
    }

    .booking-card:hover {
        transform: translateY(-5px);
    }

    .booking-status {
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .profile-filter-section {
            padding: 20px;
        }

        .profile-section {
            max-width: 100%;
        }

        .profile-image {
            margin-bottom: 10px;
        }

        .user-details {
            margin-top: 0;
        }

        .timeline {
            margin-left: 0;
            padding-left: 0;
        }
    }
    .slider-item {
    position: relative;
    background-size: cover;
    background-position: center center;
}

.slider-item .overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.slider-item .container {
    position: relative;
    z-index: 2;
}

</style>

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
                        <label for="profile_image" class="form-label">Upload a New Profile Image</label>
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

<!-- JavaScript for Countdown Timer -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @foreach ($userBookings as $booking)
        // Get the booking datetime
        var bookingDateTime = new Date("{{ \Carbon\Carbon::parse($booking->date . ' ' . $booking->time)->format('Y-m-d H:i:s') }}").getTime();

        // Set an interval to update the countdown every second
        setInterval(function() {
            var now = new Date().getTime();
            var timeLeft = bookingDateTime - now;

            // Calculate the time left in hours and minutes
            if (timeLeft > 0) {
                var hours = Math.floor((timeLeft / (1000 * 60 * 60)) % 24);
                var minutes = Math.floor((timeLeft / (1000 * 60)) % 60);
                var seconds = Math.floor((timeLeft / 1000) % 60);

                // Update the countdown text
                document.getElementById('countdown-text-{{ $booking->id }}').innerText = hours + "h " + minutes + "m " + seconds + "s";
            } else {
                document.getElementById('countdown-text-{{ $booking->id }}').innerText = "Expired";
            }
        }, 1000);
        @endforeach
    });
</script>
@push('scripts')
    <script>
        // SweetAlert success/error logic
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endpush


@endsection
