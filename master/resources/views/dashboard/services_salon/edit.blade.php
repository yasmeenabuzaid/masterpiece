@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h4 class="card-title">Edit Service</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $service->name) }}" placeholder="Enter service name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter service description">{{ old('description', $service->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="categories_id">Category</label>
            <select id="categories_id" name="categories_id" class="form-control" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}" {{ $categorie->id == $service->categories_id ? 'selected' : '' }}>
                        {{ $categorie->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $service->price) }}" placeholder="Enter service price" required min="0" step="0.01">
        </div>

        <div class="form-group">
            <label for="hours">Duration Hours</label>
            <input type="number" class="form-control" id="hours" name="hours" value="{{ old('hours', floor($service->duration / 60)) }}" placeholder="Hours" min="0">
        </div>

        <div class="form-group">
            <label for="minutes">Duration Minutes</label>
            <input type="number" class="form-control" id="minutes" name="minutes" value="{{ old('minutes', $service->duration % 60) }}" placeholder="Minutes" min="0" max="59">
        </div>

        <button type="submit"  class="btn btn-gradient-success  btn-fw">Update Service</button>
        <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
