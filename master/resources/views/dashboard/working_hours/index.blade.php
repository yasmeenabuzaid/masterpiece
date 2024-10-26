@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h3>Working Hours</h3>
    <a href="{{ route('working_hours.create') }}" class="btn btn-primary mb-3">Add Working Hour</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sub Salon ID</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Is Holiday?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workingHours as $workingHour)
            <tr>
                <td>{{ $workingHour->id }}</td>
                <td>{{ $workingHour->sub_salons_id }}</td>
                <td>{{ $workingHour->day }}</td>
                <td>{{ $workingHour->start_time ? \Carbon\Carbon::parse($workingHour->start_time)->format('H:i') : 'N/A' }}</td>
                <td>{{ $workingHour->end_time ? \Carbon\Carbon::parse($workingHour->end_time)->format('H:i') : 'N/A' }}</td>
                <td>{{ $workingHour->is_holiday ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('working_hours.edit', $workingHour->id) }}" class="btn btn-info">Edit</a>
                    <form action="{{ route('working_hours.destroy', $workingHour->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
