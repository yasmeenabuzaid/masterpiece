@extends('layouts.app-user')

@section('content')
    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-5">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('bookings.store') }}" method="POST" class="p-5 bg-white">
                        @csrf
                        <h2 class="mb-4 site-section-heading">Book Now</h2>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="fname">First Name</label>
                                <input type="text" name="first_name" id="fname" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="lname">Last Name</label>
                                <input type="text" name="last_name" id="lname" class="form-control" placeholder="Last Name" required>
                            </div>
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
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="text-black" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <label class="text-black" for="note">Notes</label>
                                <textarea name="note" id="note" cols="30" rows="5" class="form-control" placeholder="Write your notes or questions here..."></textarea>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="submit" value="Send" class="btn btn-primary py-2 px-4 text-white">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
