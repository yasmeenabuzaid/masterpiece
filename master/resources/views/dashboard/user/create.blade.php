@extends("layouts.dashboard_master")
@section("headTitle", "Create Owner")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create User</h4>
                <form class="forms-sample" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Insert name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Insert email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Insert password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="checkbox" onclick="togglePassword()"> Show Password
                    </div>

                    <div class="form-group">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm @error('salons_id') is-invalid @enderror" name="salons_id" id="salons_id" required>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                            @endforeach
                        </select>
                        @error('salons_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="usertype">User Type</label>
                        <select class="form-control" name="usertype" id="usertype" required>
                            <option value="user">User</option>
                            <option value="owner">Owner</option>
                            <option value="employee">Employee</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <img id="imagePreview" style="display: none; width: 100px; margin-top: 10px;"/>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }

    function togglePassword() {
        const passwordField = document.getElementById('password');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    }
</script>

@endsection
