@extends('layouts.dashboard_master')

@section('headTitle', 'Edit Category')

@section('content')
    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <form class="forms-sample" action="{{ route('categories.update', $categorie->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $categorie->name) }}" placeholder="Insert category name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $categorie->description) }}" placeholder="Description" required>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Update Category</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
