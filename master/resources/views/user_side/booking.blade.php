@extends('layouts.app-user')

@section('content')
<div class="main">
    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
        <h1 class="mb-5">Book Now</h1>
    </div>

    <form action="{{ route('bookings.store') }}" method="POST" class="p-5 bg-white">
        @csrf
        <input type="hidden" name="services" id="services-input">
        <h6>Welcome {{ auth()->user()->name }}</h6>
        <h5>You can book here:</h5>
        <div class="row form-group">
            @if(auth()->user()->isOwner())
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="fname">Your Name</label>
                <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
            </div>
            @endif
        </div>

        <div class="row form-group">
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="text-black" for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" required>
            </div>
        </div>

        <div class="row form-group">
            @if(auth()->user()->isOwner())
            <div class="col-md-6 mb-3 mb-md-0">
                <label class="text-black" for="email">Email</label>
                <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
            </div>
            @endif

            <div class="col-md-6">
                <label class="text-black" for="note">Notes</label>
                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <input type="submit" value="Send" class="btn btn-primary py-2 px-4 text-white" onclick="validateAndSubmit()">
            </div>
        </div>
    </form>
</div>
@endsection
