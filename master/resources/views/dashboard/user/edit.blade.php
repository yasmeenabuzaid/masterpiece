@extends("layouts.dashboard_master")
@section("headTitle", "Edit User")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <form class="forms-sample" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Insert name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Insert email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password (leave blank to keep current password)</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Insert new password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="usertype">User Type</label>
                        <select class="form-control form-control-sm @error('usertype') is-invalid @enderror" name="usertype" id="usertype" required>
                            <option value="super_admin" {{ $user->usertype == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="owner" {{ $user->usertype == 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="employee" {{ $user->usertype == 'employee' ? 'selected' : '' }}>Employee</option>
                            <option value="user" {{ $user->usertype == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('usertype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm @error('salons_id') is-invalid @enderror" name="salons_id" id="salons_id" required>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}" {{ $user->salons_id == $salon->id ? 'selected' : '' }}>{{ $salon->name }}</option>
                            @endforeach
                        </select>
                        @error('salons_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <img id="imagePreview" style="display: {{ $user->image ? 'block' : 'none' }}; width: 100px; margin-top: 10px;" src="{{ asset($user->image) }}" />

                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
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
</script>

@endsection
