@if (auth()->check() && auth()->user()->isSuperAdmin()||auth()->user()->isOwner())

@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h4 class="card-title">Create Booking</h4>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Booking Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter booking name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter booking description"></textarea>
        </div>

        <div class="form-group">
            <label for="appointment_date">Appointment Date</label>
            <input type="datetime-local" class="form-control" id="appointment_date" name="appointment_date" required>
        </div>

        <div class="form-group">
            <label for="employees_id">Employee</label>
            <select name="employees_id" id="employees_id" class="form-control" required>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}">
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="castomors_id">Customer</label>
            <select id="castomors_id" name="castomors_id" class="form-control" required>
                @foreach ($castomors as $castomor)
                    <option value="{{ $castomor->id }}">{{$castomor->first_name}} {{ $castomor->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="services_id">Service</label>
            <select id="services_id" name="services_id" class="form-control" required>
                @foreach ($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-gradient-primary me-2">Create Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
@endif
