@extends('layouts.dashboard_master')

@section('content')
<div class="container mt-4">
    <h4 class="card-title">Show More Details for {{ $subsalon->salon->name }} </h4>
    <hr>

    <div class="row mb-4">
        @if($images->isEmpty())
            <div class="col-12">
                <img src="{{ asset('path/to/default-image.jpg') }}" alt="No images available" class="img-fluid" style="height: 200px; object-fit: cover;">
                {{-- <p>No images available.</p> --}}
            </div>
        @else
            @foreach($images as $image)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="{{ asset($image->image) }}" alt="Image" class="card-img-top img-thumbnail" style="height: 200px; object-fit: cover;">
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <hr>
 <br>
    <div class="row mb-4">
        <div class="col-md-12">
            <h3>Details</h3>
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td><strong>Parent Salon:</strong></td>
                        <td>{{ $subsalon->salon->name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Location:</strong></td>
                        <td>{{ $subsalon->location }}</td>
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
                        <td><strong>Working Hours:</strong></td>
                        <td>
                            {{ date('H:i', strtotime($subsalon->opening_hours_start)) }} -
                            {{ date('H:i', strtotime($subsalon->opening_hours_end)) }}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Working Days:</strong></td>
                        <td>
                            @if(is_array($subsalon->working_days))
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
                    </tr>
                </tbody>
            </table>
        <br>
            <a href="{{ route('subsalons.index') }}" class="btn btn-gradient-success btn-fw">Back to SubSalons</a>
        </div>
    </div>
</div>
@endsection
