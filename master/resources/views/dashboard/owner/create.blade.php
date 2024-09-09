@extends("layouts.dashboard_master")
@section("headTitle", "Create Owner")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Owner</h4>
                <form class="forms-sample" action="{{ route('owners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Insert first name" value="{{ old('first_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Insert last name" value="{{ old('last_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Insert email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Insert password" required>
                    </div>
                    <div class="form-group">
                        <label for="salons_id">Salon</label>
                        <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                            @foreach ($salons as $salon)
                                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert phone number" value="{{ old('phone') }}" required>
                    </div> --}}
                    <div class="form-group">
                        <label for="image">Profile Image</label>
                        <input type="file" name="image" id="fileUpload" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="{{ route('owners.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
