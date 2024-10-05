@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
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
            <label for="employee_id">Employee</label>
            <select class="form-control form-control-sm" name="user_id" id="employee_id" required>
                @if ($employees->isEmpty())
                    <option disabled>No Employees Found</option>
                @else
                    @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select class="form-control form-control-sm" name="user_id" id="customer_id" required>
                @if ($customers->isEmpty())
                    <option disabled>No Customers Found</option>
                @else
                    @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                    @endforeach
                @endif
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
