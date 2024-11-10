@extends('layouts.dashboard_master')

@section('content')
    <div class="container">
        <h3 class="mb-4"><i class="fas fa-user-circle"></i> Your Profile</h3>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <!-- Profile Image Section -->
            <div class="col-md-4 text-center mb-4">
                <div class="form-group">
                    <!-- Check if user has uploaded an image, otherwise use a default image -->
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

            <!-- User Information Section -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <!-- User Name -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label"><i class="fas fa-user"></i> Name</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->name }}</p>
                            </div>
                        </div>

                        <!-- User Email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label"><i class="fas fa-envelope"></i>
                                Email</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ $user->email }}</p>
                            </div>
                        </div>

                        <!-- User Type -->
                        <div class="form-group row">
                            <label for="usertype" class="col-md-3 col-form-label"><i class="fas fa-user-tag"></i> User
                                Type</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">{{ ucfirst($user->usertype) }}</p>
                            </div>
                        </div>

                        <!-- Salon and Sub-Salon Information (if applicable) -->
                        @if ($user->usertype !== 'super_admin')
                            <div class="form-group row">
                                <label for="salon" class="col-md-3 col-form-label"><i class="fas fa-building"></i>
                                    Salon</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">
                                        {{ $user->salon ? $user->salon->name : 'No Salon Assigned' }}</p>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sub_salon" class="col-md-3 col-form-label"><i class="fas fa-cogs"></i> Sub
                                    Salon</label>
                                <div class="col-md-9">
                                    <p class="form-control-plaintext">
                                        {{ $user->subSalon ? $user->subSalon->name : 'No Sub Salon Assigned' }}</p>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="created_at" class="col-md-3 col-form-label"><i class="fas fa-calendar-alt"></i>
                                Account Created</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">
                                    <strong>Date:</strong> {{ $user->created_at->format('Y-m-d') }}
                                </p>
                                <p class="form-control-plaintext">
                                    <strong>Time:</strong> {{ $user->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <!-- User Last Updated -->
                        <div class="form-group row">
                            <label for="updated_at" class="col-md-3 col-form-label"><i class="fas fa-calendar-check"></i>
                                Last Updated</label>
                            <div class="col-md-9">
                                <p class="form-control-plaintext">
                                    <strong>Date:</strong> {{ $user->updated_at->format('Y-m-d') }}
                                </p>
                                <p class="form-control-plaintext">
                                    <strong>Time:</strong> {{ $user->updated_at->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-12 text-right mt-4">
                            <a href="{{ route('users.editProfile') }}" class="btn btn-primary btn-lg">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Move the Edit Profile Button to the Bottom -->
    </div>
@endsection
