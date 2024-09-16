@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h4 class="card-title">Create Service</h4>
    <form action="{{ route('services.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Service Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter service name" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter service description"></textarea>
        </div>

        <div class="form-group">
            <label for="sub_salons_id">Sub Salon</label>
            <select name="sub_salons_id" id="sub_salons_id" class="form-control" required>
                @foreach($sub_salons as $sub_salon)
                    <option value="{{ $sub_salon->id }}">
                        {{ $sub_salon->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="categories_id">Category</label>
            <select id="categories_id" name="categories_id" class="form-control" required>
                @foreach ($categories as $categorie)
                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="subcats_id">Subcategory</label>
            <select id="subcats_id" name="subcats_id" class="form-control" required>
                @foreach ($subcats as $subcat)
                    <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-gradient-primary me-2">Create Service</button>
        <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
    </form>
</div>
@endsection
