@extends('layouts.app-user')

@section('content')
<style>
    .booking-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin: 50px ;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .countdown {
        font-weight: bold;
        color: #d9534f;
    }
</style>

@foreach($bookings as $booking)
    <div class="booking-card">
        <div class="booking-header">
            <h4>Booking ID: {{ htmlspecialchars($booking->id) }}</h4>
            <span class="countdown" id="countdown-{{ $booking->id }}" aria-live="polite"></span>
        </div>
        <p>Date: {{ htmlspecialchars($booking->date) }}</p>
        <p>Time: {{ htmlspecialchars($booking->time) }}</p>
        {{-- <p>Notes: {{ htmlspecialchars($booking->note) }}</p> --}}
    </div>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($bookings as $booking)
            const bookingTime = new Date("{{ $booking->date }} {{ $booking->time }}").getTime();
            const countdownElement = document.getElementById("countdown-{{ $booking->id }}");

            const countdownInterval = setInterval(() => {
                const now = new Date().getTime();
                const distance = bookingTime - now;

                // Calculate time remaining
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Display remaining time
                countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

                // If the time has expired
                if (distance < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "Expired";
                }
            }, 1000);
        @endforeach
    });
</script>
@endsection
