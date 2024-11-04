@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h3>{{ $salon->name }}</h3>
        <p>{{ $salon->description }}</p>
        @if ($salon->image)
            <img src="{{ asset($salon->image) }}" alt="Salon Image" style="width: 300px;">
        @endif
        <a href="{{ route('salons.index') }}" class="btn btn-secondary">Back to Salons</a>
    </div>
@endsection
