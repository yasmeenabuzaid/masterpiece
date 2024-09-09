@extends('layouts.dashboard_master')
@section('headTitle', 'Edit Owner')
@section('content')

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Owner</h4>
                <form class="forms-sample" action="{{ route('owners.update', $owner->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Insert first name" value="{{ old('first_name', $owner->first_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Insert last name" value="{{ old('last_name', $owner->last_name) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Insert email" value="{{ old('email', $owner->email) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Insert new password (leave empty if not changing)">
                    </div>
                    <div class="form-group">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}" {{ $salon->id == $owner->salons_id ? 'selected' : '' }}>
                                    {{ $salon->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control">
                        @if($owner->image)
                            <img src="{{ asset($owner->image) }}" alt="Owner Image" width="100">
                        @endif
                    </div> --}}
                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                    <a href="{{ route('owners.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
