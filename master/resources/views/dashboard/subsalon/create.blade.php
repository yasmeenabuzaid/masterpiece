@extends('layouts.dashboard_master')

@section('headTitle', 'Create SubSalon')

@section('content')
<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create SubSalon</h4>
                <form class="forms-sample" action="{{ route('subsalons.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Insert address" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert phone number" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}" {{ old('salons_id') == $salon->id ? 'selected' : '' }}>
                                    {{ $salon->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('salons_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Create</button>
                    <a href="{{ route('subsalons.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
