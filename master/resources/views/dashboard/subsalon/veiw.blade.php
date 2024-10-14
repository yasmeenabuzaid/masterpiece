@extends('layouts.dashboard_master')

@section('content')
<style>
    .flex-container {
    display: flex;
    align-items: flex-start;
}

.image {
    max-width: 400px;
    margin-right: 20px;
}

.details {
    flex-grow: 1;
}

.placeholder-image {
    width: 200px;
    height: 200px;
    background-color: #ccc;
    margin-right: 20px;
}

    </style>
<div class="container">
    <div class="flex-container">
        @if($subsalon->image)
            <img src="{{ asset($subsalon->image) }}" alt="Image" class="image">
        @else
            <div class="placeholder-image"></div>
        @endif

        <div class="details">
            <h3 class="title-1">{{ $subsalon->name }}</h3>
            <p>Description: {{ $subsalon->description }}</p>
            <p>Address: {{ $subsalon->address }}</p>
            <p>Phone: {{ $subsalon->phone }}</p>
            <p>Created At: {{ $subsalon->created_at->format('Y-m-d H:i') }}</p>
            <a href="{{ route('subsalons.index') }}">
                <button type="button" class="btn btn-gradient-success btn-rounded btn-fw">Back to list</button>
            </a>
        </div>
    </div>
</div>
@endsection
