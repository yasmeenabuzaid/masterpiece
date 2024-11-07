@extends('layouts.app-user')

@section('content')
<style>
    .booking-card {
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        margin: 50px;
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
    /* إضافة CSS لتمركز النص في منتصف الصفحة */
    .no-booking-message {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50vh; /* اجعل ارتفاع العنصر يملأ الشاشة */
        font-size: 20px;
        color: #333;
        text-align: center;
    }
</style>

@if($userBookings->isEmpty())
    <div class="no-booking-message">
        <p>No bookings available at the moment.</p>
    </div>
@else
    @foreach($userBookings as $booking)
        <div class="booking-card">
            <div class="booking-header">
                <h4>Booking ID: {{ htmlspecialchars($booking->id) }}</h4>
                <span class="countdown" id="countdown-{{ $booking->id }}" aria-live="polite"></span>
            </div>
            <p>Date: {{ htmlspecialchars($booking->date) }}</p>
            <p>Time: {{ htmlspecialchars($booking->time) }}</p>
        </div>
    @endforeach
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @foreach($userBookings as $booking)
            const bookingTime = new Date("{{ $booking->date }} {{ $booking->time }}").getTime();
            const countdownElement = document.getElementById("countdown-{{ $booking->id }}");

            const countdownInterval = setInterval(() => {
                const now = new Date().getTime();
                const distance = bookingTime - now;

                // حساب الوقت المتبقي
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // عرض الوقت المتبقي
                countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;

                // إذا انتهى الوقت
                if (distance < 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "Expired";
                }
            }, 1000);
        @endforeach
    });
</script>
@endsection
