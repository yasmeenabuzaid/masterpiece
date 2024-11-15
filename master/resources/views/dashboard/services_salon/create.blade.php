@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h4 class="card-title">Create Service</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
                <label for="categories_id">Category</label>
                <select id="categories_id" name="categories_id" class="form-control" required>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="hours">Duration (Hours)</label>
                <input type="number" class="form-control" id="hours" name="hours" placeholder="Please enter duration as hours" min="0" max="23" value="0" required>
            </div>

            <div class="form-group">
                <label for="minutes">Duration (Minutes)</label>
                <input type="number" class="form-control" id="minutes" name="minutes" placeholder="Please enter duration as minutes (00-59)." min="0" max="59" value="0" required>
            </div>

            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Enter service price" min="0" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-gradient-success btn-fw">Create Service</button>
            <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
        </form>
    </div>
@endsection
