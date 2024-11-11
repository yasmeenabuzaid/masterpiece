@extends("layouts.dashboard_master")
@section("headTitle", "Edit User")
@section("content")
@if (auth()->check() && auth()->user()->isSuperAdmin())

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User</h4>
                <form id="editForm" action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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

                    <div class="form-group" id="salonsField" style="display: {{ $user->usertype === 'owner' ? 'block' : 'none' }};">
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

                    <div class="form-group" id="subsalonsField" style="display: {{ $user->usertype === 'employee' ? 'block' : 'none' }};">
                        <label for="subsalons_id">SubSalon</label>
                        <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id">
                            @foreach ($subsalons as $subsalon)
                                <option value="{{ $subsalon->id }}" {{ $user->sub_salons_id == $subsalon->id ? 'selected' : '' }}>{{ $subsalon->address }}</option>
                            @endforeach
                        </select>
                        @error('sub_salons_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control" accept="image/*" onchange="previewImage(event)">
                    </div>
                    <img id="imagePreview" style="display: {{ $user->image ? 'block' : 'none' }}; width: 100px; margin-top: 10px;" src="{{ asset($user->image) }}" />

                    <button type="button" class="btn btn-gradient-success btn-fw" onclick="confirmEdit(event)">Update</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@if (auth()->check() && auth()->user()->isOwner())
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
                            <select class="form-control" name="usertype" id="usertype" required onchange="toggleSalonFields()">
                                <option value="employee" {{ old('usertype', $user->usertype) == 'employee' ? 'selected' : '' }}>Employee</option>
                            </select>
                        </div>

                        <!-- Hidden Salon ID for Owner -->
                        <div class="form-group" id="salonField" style="display: block;">
                            <!-- Hidden salon ID -->
                            <input type="hidden" name="salons_id" id="salons_id" value="{{ auth()->user()->salons_id }}" />
                            <!-- You can still display the salon name, but not allow modification -->
                            @isset(auth()->user()->salons)
                                <input type="hidden" class="form-control" value="{{ auth()->user()->salons->name }}" readonly />
                            @else
                                <input type="hidden" class="form-control" value="No salon assigned" readonly />
                            @endisset
                        </div>

                        <div class="form-group" id="subsalonField" style="display: block;">
                            <label for="subsalons_id">SubSalon</label>
                            <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id">
                                @foreach ($subsalons as $subsalon)
                                    @if ($subsalon->salon_id == auth()->user()->salons_id)
                                        <option value="{{ $subsalon->id }}" {{ $user->sub_salons_id == $subsalon->id ? 'selected' : '' }}>{{ $subsalon->address }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('sub_salons_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw">Update</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif



<!-- Confirmation Modal -->
<div id="confirmationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; z-index: 1000; padding:20px;">
    <div style="background: #fff; padding: 20px; border-radius: 5px; text-align: center;">
        <h3><i class="fas fa-pencil-alt" style="font-size: 2rem; color: #007bff;"></i></h3>
        <p>Are you sure you want to edit this user?</p>
        <button id="confirmButton" class="btn btn-primary">Edit</button>
        <button id="cancelButton" class="btn btn-secondary">Cancel</button>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }

    document.getElementById('usertype').addEventListener('change', function() {
        const userType = this.value;
        document.getElementById('salonsField').style.display = userType === 'owner' ? 'block' : 'none';
        document.getElementById('subsalonsField').style.display = userType === 'employee' ? 'block' : 'none';
    });

    // تنشيط التحديث بناءً على النوع عند تحميل الصفحة
    window.onload = function() {
        const userType = document.getElementById('usertype').value;
        document.getElementById('salonsField').style.display = userType === 'owner' ? 'block' : 'none';
        document.getElementById('subsalonsField').style.display = userType === 'employee' ? 'block' : 'none';
    };

    function confirmEdit(event) {
        event.preventDefault();
        var modal = document.getElementById('confirmationModal');
        var confirmButton = document.getElementById('confirmButton');
        var cancelButton = document.getElementById('cancelButton');
        modal.style.display = 'flex';

        confirmButton.onclick = function() {
            document.getElementById('editForm').submit();
        };

        cancelButton.onclick = function() {
            modal.style.display = 'none';
        };
    }
</script>

@endsection
