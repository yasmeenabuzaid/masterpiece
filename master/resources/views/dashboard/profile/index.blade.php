@extends('layouts.dashboard_master')

@section('content')
<style>
    /* profile.css */
    .profile-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background-color: #f8f9fa; /* Light background for contrast */
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .nav-profile-text {
        width: 100%;
        padding: 20px;
    }

    .nav-profile-text h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    .nav-profile-text h3 {
        margin: 10px 0;
        font-size: 18px;
    }

    .edit-btn {
        color: white;
        border: none;
        margin-top: 30px;
        cursor: pointer;
    }

    .profile-image {
        width: 200px;
        height: 200px;
        border-radius: 8px;
        border: 2px solid black;
    }
</style>

<div class="profile-container">
    <div class="nav-profile-text d-flex flex-column">
        <h1>Profile</h1>
        <br>
        @if(isset($user))
            <h3>First Name: {{ $user->name }}</h3>
            <h3>Phone: {{ $user->phone }}</h3>
            <h3>Email: {{ $user->email }}</h3>
            <h3>User Type: {{ $user->usertype }}</h3>
            <h3>Salon ID: {{ $user->salon_id }}</h3>
            <h3>Sub Salons ID: {{ $user->sub_salons_id }}</h3>
            <div style="margin-top: 20px;">
                <a href="{{ route('profiles.edit', $user->id) }}" class="edit-btn">
                    <button type="button" class="btn btn-gradient-success btn-rounded btn-fw">Edit Profile</button>
                </a>
            </div>
        @else
            <p>User not found.</p>
        @endif
    </div>

    <div style="width: 400px; padding: 20px;">
        <img src="{{ $user->image ?? 'https://static.vecteezy.com/system/resources/previews/001/840/612/non_2x/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-free-vector.jpg' }}"
             alt="Profile" class="profile-image"/>
    </div>
</div>
@endsection
