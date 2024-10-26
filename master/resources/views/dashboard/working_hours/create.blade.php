@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h3>Create Working Hour</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('working_hours.store') }}" method="POST" id="workingHourForm">
        @csrf

        <div class="form-group">
            <label for="sub_salons_id">SubSalon</label>
            <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id" required>
                <option value="">Select SubSalon</option>
                @foreach ($subsalons as $subsalon)
                    <option value="{{ $subsalon->id }}">{{ $subsalon->name }}</option>
                @endforeach
            </select>
            @error('sub_salons_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
           <label for="day">Day</label>
            <select name="day" class="form-control @error('day') is-invalid @enderror" required>
                <option value="">Select a day</option>
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
            @error('day')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="is_holiday">Is Holiday?</label>
            <input type="checkbox" name="is_holiday" value="1" id="is_holiday" class="form-check-input" onchange="toggleTimeFields()">
        </div>

        <div class="form-group">
            <label for="start_time">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control @error('start_time') is-invalid @enderror" required>
            @error('start_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="end_time">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control @error('end_time') is-invalid @enderror" required>
            @error('end_time')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>

<script>
    function toggleTimeFields() {
        const isHolidayCheckbox = document.getElementById('is_holiday');
        const startTimeField = document.getElementById('start_time');
        const endTimeField = document.getElementById('end_time');

        if (isHolidayCheckbox.checked) {
            startTimeField.disabled = true;
            endTimeField.disabled = true;
            startTimeField.value = '';
            endTimeField.value = '';
        } else {
            startTimeField.disabled = false;
            endTimeField.disabled = false;
        }
    }
</script>
@endsection
