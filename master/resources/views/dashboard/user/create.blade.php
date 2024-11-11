@extends("layouts.dashboard_master")
@section("headTitle", "Create User")
@section("content")
@if (auth()->check() && auth()->user()->isSuperAdmin())

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
                        <label for="usertype">User Type</label>
                        <select class="form-control" name="usertype" id="usertype" required onchange="toggleSalonFields()">
                            <option value="user">customer</option>
                            <option value="owner">Owner</option>
                            <option value="employee">Employee</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                    </div>

                    <div class="form-group" id="salonField" style="display: none;">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm @error('salons_id') is-invalid @enderror" name="salons_id" id="salons_id">
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                            @endforeach
                        </select>
                        @error('salons_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="subsalonField" style="display: none;">
                        <label for="subsalons_id">SubSalon</label>
                        <select class="form-control form-control-sm @error('sub_salon_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id">
                            @foreach ($subsalons as $subsalon)
                                <option value="{{ $subsalon->id }}">{{ $subsalon->name }}</option>
                            @endforeach
                        </select>
                        @error('subsalons_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    <button type="submit"  class="btn btn-gradient-success btn-rounded btn-fw">Submit</button>
                    <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
<!-- عند الـ Owner، نجعل حقل الصالون مخفيًا ولكن يتم إرساله في النموذج -->
@if (auth()->check() && auth()->user()->isOwner())
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
                            <label for="usertype">User Type</label>
                            <select class="form-control" name="usertype" id="usertype" required onchange="toggleSalonFields()">
                                <option value="employee">Employee</option>
                            </select>
                        </div>

                        <!-- Set the salon field to the owner’s salon (Hidden) -->
                        <div class="form-group" id="salonField" style="display: none;">
                            <label for="salons_id">Salon</label>
                            <!-- Hidden salon ID field -->
                            <input type="hidden" name="salons_id" id="salons_id" value="{{ auth()->user()->salons_id }}" />
                            <!-- Display salon name as read-only -->
                            @isset(auth()->user()->salons)
                            <input type="text" class="form-control" value="{{ auth()->user()->salons->name }}" readonly />
                        @else
                            <input type="text" class="form-control" value="No salon assigned" readonly />
                        @endisset

                            @error('salons_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Display only sub salons of the associated salon -->
                        <div class="form-group" id="subsalonField" style="display: block;">
                            <label for="subsalons_id">SubSalon</label>
                            <select class="form-control form-control-sm @error('sub_salons_id') is-invalid @enderror" name="sub_salons_id" id="sub_salons_id">
                                @foreach ($subsalons as $subsalon)
                                    @if ($subsalon->salon_id == auth()->user()->salons_id)
                                        <option value="{{ $subsalon->id }}">{{ $subsalon->address }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('subsalons_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-gradient-success btn-rounded btn-fw">Submit</button>
                        <a href="{{ route('users.index') }}" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif


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
</script>

@endsection
