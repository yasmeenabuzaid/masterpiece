@extends('layouts.dashboard_master')

@section('content')
<div class="container">
    <h3 class="mb-4"><i class="fas fa-user-circle"></i> Update Your Profile</h3>

    <div class="row">
        <!-- Profile Image Section -->
        <div class="col-md-4 text-center mb-4">
            <div class="form-group">
                <!-- Display current profile image or default if not available -->
                <img src="{{ $user->image ? asset($user->image) : asset('https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg') }}"
                alt="Profile Image"
                class="img-fluid"
                style="margin-top:40px;
                       width: 250px;
                       height: 250px;
                       border-radius: 50%;
                       border: 2px solid #616161;
                       object-fit: cover;">
            </div>
        </div>

        <!-- Profile Edit Form Section -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- User Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label"><i class="fas fa-user"></i> Name</label>
                            <div class="col-md-9">
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- User Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label"><i class="fas fa-envelope"></i> Email</label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- User Password (Optional) -->
                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label"><i class="fas fa-lock"></i> Password</label>
                            <div class="col-md-9">
                                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current password">
                                @error('password')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Profile Image Upload -->
                        <div class="form-group row">
                            <label for="image" class="col-md-3 col-form-label"><i class="fas fa-image"></i> Profile Image</label>
                            <div class="col-md-9">
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                                <!-- Note for the user -->
                                <small class="form-text text-muted">
                                    The image you upload will be applied after saving the changes.
                                </small>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group row mt-4">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
