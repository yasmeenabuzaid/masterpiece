@extends('layouts.dashboard_master')

@section('content')
    <div class="container mt-4">
        <h4 class="card-title">Show More Details for {{ $salon->name }}</h4>
        <hr>

        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset($salon->image) }}" alt="Image" class="card-img-top img-thumbnail"
                        style="height: 200px; object-fit: cover;">
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <h3>Details</h3>
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td><strong>name</strong></td>
                            <td>{{ $salon->name }}</td>
                        </tr>
                        <tr>
                            <td><strong>description:</strong></td>
                            <td>{{ $salon->description }}</td>
                        </tr>
                        {{-- <tr>
                        <td><strong>Address:</strong></td>
                        <td>{{ $subsalon->address }}</td>
                    </tr>
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{ $subsalon->description }}</td>
                    </tr>
                    <tr>
                        <td><strong>Phone:</strong></td>
                        <td>{{ $subsalon->phone }}</td>
                    </tr> --}}
                        {{-- <tr>
                        <td><strong>Working Hours:</strong></td>
                        <td>
                            {{ date('H:i', strtotime($subsalon->opening_hours_start)) }} -
                            {{ date('H:i', strtotime($subsalon->opening_hours_end)) }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Working Days:</strong></td>
                        <td>
                            @if (is_array($subsalon->working_days))
                                {{ implode(', ', $subsalon->working_days) }}
                            @else
                                Not specified
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Type:</strong></td>
                        <td>{{ ucfirst($subsalon->type) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Available:</strong></td>
                        <td>{{ $subsalon->is_available ? 'Yes' : 'No' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Number of Employees:</strong></td>
                        <td>{{ $subsalon->usersCount() > 0 ? $subsalon->usersCount() : 'No associated employees'  }}</td>
                    </tr> --}}
                    </tbody>
                </table>
                <br>
                <br>
                <a href="{{ route('salons.index') }}" class="btn btn-custom ">Back to SubSalons</a>
            </div>
        </div>
    </div>
@endsection
