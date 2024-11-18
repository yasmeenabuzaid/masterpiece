{{-- @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h4 class="card-title">Create New Booking</h4>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf


        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter booking description"></textarea>
        </div>

        <div class="form-group">
            <label for="appointment_date">Appointment Date</label>
            <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>

        <div class="form-group">
            <label for="user_id">Select User</label>
            <select class="form-control" id="user_id" name="user_id" required>
                <option value="">Select a user</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sub_salons_id">SubSalon (Required)</label>
            <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id" required>
                <option value="">Select a SubSalon</option>
                @foreach ($subsalons as $subsalon)
                    <option value="{{ $subsalon->id }}">{{ $subsalon->name }}</option>
                @endforeach
            </select>
            @error('sub_salons_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit"  class="btn btn-gradient-success btn-rounded btn-fw">Create Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
@endif --}}
