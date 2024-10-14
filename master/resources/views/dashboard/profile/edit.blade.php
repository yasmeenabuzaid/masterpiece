@extends('layouts.dashboard_master')

@section('content')
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <div class="nav-profile-text d-flex flex-column" style="width: 100%; padding: 20px;">
            <h1>Edit Profile</h1>
            <br>
            <form class="forms-sample" action="{{ route('profiles.update', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ old('user', $user->name) }}" placeholder="Insert first name" required>
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="text" class="form-control" id="password" name="password"
                        value="{{ old('user', $user->password) }}" placeholder="Insert last name" required>
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="text" class="form-control" id="email" name="email"
                        value="{{ old('user', $user->email) }}" placeholder="Description" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ old('user', $user->phone) }}" placeholder="Phone" required>
                </div>

                <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                <button type="button" class="btn btn-light" onclick="window.history.back();">Cancel</button>
            </form>
        </div>
        <div style="width: 400px; padding: 20px;">
            <img src="{{ $profile->image ?? 'https://static.vecteezy.com/system/resources/previews/001/840/612/non_2x/picture-profile-icon-male-icon-human-or-people-sign-and-symbol-free-vector.jpg' }}"
                alt="Profile" style="width: 200px; height: 200px; border-radius:0px; border: black solid 2px;" />
        </div>
    </div>
@endsection
