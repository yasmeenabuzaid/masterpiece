@extends('layouts.dashboard_master')

@section('content')

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Subcategory</h4>
                <form class="forms-sample" action="{{ route('subcategories.update', $subcat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $subcat->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $subcat->description) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="categories_id">Category</label>
                        <select id="categories_id" name="categories_id" class="form-control" required>
                            @foreach ($categories as $categorie)
                                <option value="{{ $categorie->id }}" {{ $subcat->categories_id == $categorie->id ? 'selected' : '' }}>
                                    {{ $categorie->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Update Subcategory</button>
                    <a href="{{ route('subcategories.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
