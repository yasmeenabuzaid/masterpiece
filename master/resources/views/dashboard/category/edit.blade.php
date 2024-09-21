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

                        @if (auth()->user()->isSuperAdmin())
                            <div class="form-group">
                                <label for="salons_id">Salon</label>
                                <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                                    @foreach ($salons as $salon)
                                        <option value="{{ $salon->id }}" {{ $salon->id == $categorie->salons_id ? 'selected' : '' }}>
                                            {{ $salon->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="salons_id" value="{{ $categorie->salons_id }}">
                            <div class="form-group">
                                {{-- <label>Salon</label>
                                <p class="form-control-plaintext">{{ $categorie->salon->name }}</p> --}}
                            </div>
                        @endif

                        <button type="submit" class="btn btn-gradient-primary me-2">Update Category</button>
                        <a href="{{ route('categories.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
