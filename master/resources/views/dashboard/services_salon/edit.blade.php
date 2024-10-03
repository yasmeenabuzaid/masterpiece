@if (auth()->check() && auth()->user()->isSuperAdmin()||auth()->user()->isOwner())

@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h4 class="card-title">Edit Service</h4>
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
            <label for="sub_salons_id">Sub Salon</label>
            <select name="sub_salons_id" id="sub_salons_id" class="form-control" required>
                @foreach($sub_salons as $sub_salon)
                    <option value="{{ $sub_salon->id }}" {{ $sub_salon->id == $service->sub_salons_id ? 'selected' : '' }}>
                        {{ $sub_salon->name }}
                    </option>
                @endforeach
            </select>
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
            <label for="subcats_id">Subcategory</label>
            <select id="subcats_id" name="subcats_id" class="form-control" required>
                @foreach ($subcats as $subcat)
                    <option value="{{ $subcat->id }}" {{ $subcat->id == $service->subcats_id ? 'selected' : '' }}>
                        {{ $subcat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-gradient-primary me-2">Update Service</button>
        <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
@endif
