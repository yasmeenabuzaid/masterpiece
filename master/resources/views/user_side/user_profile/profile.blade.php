@extends('layouts.app-user')

@section('content')
<div class="user-form-container">
    <h2>Update User Information</h2>

    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Leave blank to keep unchanged">
            @error('password') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="usertype">User Type:</label>
            <select id="usertype" name="usertype" required>
                <option value="super_admin" {{ old('usertype', $user->usertype) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                <option value="owner" {{ old('usertype', $user->usertype) == 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="employee" {{ old('usertype', $user->usertype) == 'employee' ? 'selected' : '' }}>Employee</option>
                <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>User</option>
            </select>
            @error('usertype') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="salons_id">Salon:</label>
            <select id="salons_id" name="salons_id">
                <option value="">Select Salon</option>
                @foreach($salons as $salon)
                    <option value="{{ $salon->id }}" {{ old('salons_id', $user->salons_id) == $salon->id ? 'selected' : '' }}>{{ $salon->name }}</option>
                @endforeach
            </select>
            @error('salons_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="sub_salons_id">Sub Salon:</label>
            <select id="sub_salons_id" name="sub_salons_id">
                <option value="">Select Sub Salon</option>
                @foreach($subSalons as $subSalon)
                    <option value="{{ $subSalon->id }}" {{ old('sub_salons_id', $user->sub_salons_id) == $subSalon->id ? 'selected' : '' }}>{{ $subSalon->name }}</option>
                @endforeach
            </select>
            @error('sub_salons_id') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="image">Profile Image:</label>
            <input type="file" id="image" name="image">
            @if($user->image)
                <img src="{{ asset($user->image) }}" alt="User Image" class="profile-image">
            @endif
            @error('image') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.profile') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<!-- CSS for styling -->
<style>
    /* Form container */
    .user-form-container {
        width: 50%;
        margin: 0 auto;
        padding: 30px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    /* Form group */
    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        font-weight: bold;
        margin-bottom: 8px;
    }

    input[type="text"], input[type="email"], input[type="password"], select, input[type="file"] {
        width: 100%;
        padding: 10px;
        font-size: 14px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus, input[type="file"]:focus {
        border-color: #007bff;
        outline: none;
    }

    /* Error messages */
    .error {
        color: red;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Profile image */
    .profile-image {
        margin-top: 10px;
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Form buttons */
    .form-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    button[type="submit"], .btn {
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button[type="submit"] {
        background-color: #007bff;
        color: white;
        border: none;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }
</style>
@endif
