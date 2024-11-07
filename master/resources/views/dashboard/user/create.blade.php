@extends("layouts.dashboard_master")
@section("headTitle", "Create User")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create User</h4>
                <form class="forms-sample" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Insert name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Insert email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Insert password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="checkbox" onclick="togglePassword()"> Show Password
                    </div>

                    <!-- User Type Field -->
                    <div class="form-group">
                        <label for="usertype">User Type</label>
                        <select class="form-control" name="usertype" id="usertype" required onchange="toggleSalonFields()">
                            <option value="user">Customer</option>
                            <option value="owner">Owner</option>
                            <option value="employee">Employee</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                  <!-- حقل الصالون -->
<div class="form-group" id="salonField" style="display: none;">
    <label for="salons_id">Salon</label>
    <select class="form-control form-control-sm @error('salons_id') is-invalid @enderror" name="salons_id" id="salons_id">
        @foreach ($salons as $salon)
            <option value="{{ $salon->id }}" {{ old('salons_id') == $salon->id ? 'selected' : '' }}>{{ $salon->name }}</option>
        @endforeach
    </select>
    @error('salons_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- حقل السب صالون -->
<div class="form-group" id="subsalonField" style="display: none;">
    <label for="subsalons_id">SubSalon</label>
    <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id">
        @foreach ($subsalons as $subsalon)
            <option value="{{ $subsalon->id }}" {{ old('sub_salons_id') == $subsalon->id ? 'selected' : '' }}>{{ $subsalon->address }}</option>
        @endforeach
    </select>
    @error('sub_salons_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



                    <!-- Profile Image -->
                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <img id="imagePreview" style="display: none; width: 100px; margin-top: 10px;"/>

                    <!-- Submit Button -->
                    <button type="submit"  class="btn btn-gradient-success btn-rounded btn-fw">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Preview Image Function
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }

    // Toggle Password Visibility
    function togglePassword() {
        const passwordField = document.getElementById('password');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    }

   // Toggle Salon and SubSalon Fields Based on User Type
function toggleSalonFields() {
    const userType = document.getElementById('usertype').value;
    const salonField = document.getElementById('salonField');
    const subsalonField = document.getElementById('subsalonField');

    if (userType === 'employee') {
        salonField.style.display = 'none';
        subsalonField.style.display = 'block';
    } else if (userType === 'owner') {
        salonField.style.display = 'block';
        subsalonField.style.display = 'none';
    } else {
        salonField.style.display = 'none';
        subsalonField.style.display = 'none';
    }
}


    // Call the function on page load to set the initial state of fields
    document.addEventListener('DOMContentLoaded', function () {
        toggleSalonFields(); // Ensure fields are set based on the selected user type
    });
</script>

@endsection
