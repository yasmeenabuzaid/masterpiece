@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))

@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="title-1">Edit Booking</h2>
        <a href="{{ route('bookings.index') }}">
            <button type="button" class="btn btn-secondary">
                <i class="zmdi zmdi-arrow-back"></i> Back to List
            </button>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('bookings.update', $booking->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $booking->name) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="appointment_date">Appointment Date</label>
                            <input type="date" class="form-control" id="appointment_date" name="appointment_date" value="{{ old('appointment_date', $booking->appointment_date->format('Y-m-d')) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description">{{ old('description', $booking->description) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">Select a user</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == old('user_id', $booking->user_id) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"  class="btn btn-gradient-success btn-rounded btn-fw">Update Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
