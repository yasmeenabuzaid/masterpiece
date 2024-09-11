@extends('layouts.dashboard_master')

@section('headTitle', 'Create SubSalon')

@section('content')
<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create SubSalon</h4>
                <form class="forms-sample" action="{{ route('subsalons.store') }}" method="POST" enctype="multipart/form-data">
                    {{-- enctype="multipart/form-data" -> بتخليني ابعت انواع داتا مختلفه --}}

                    @csrf
                    

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert name"  required>

                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Insert address"  required>
                     
                    </div>
                    <div class="form-group">
                        <label for="description">description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Insert description"  required>
                     
                    </div>
                    <div class="form-group">
                        <label for="phone">phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert phone"  required>
                     
                    </div>
            <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" name="image" id="fileUpload" class="form-control">
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
