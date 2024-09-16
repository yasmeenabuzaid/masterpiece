@extends('layouts.dashboard_master')

@section('headTitle', 'Edit Employee')

@section('content')
<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Employee</h4>
                <form class="forms-sample" action="{{ route('employees.update', $employee->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Specify that this is a PUT request for updating -->

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $employee->first_name) }}" placeholder="Insert first name" required>
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $employee->last_name) }}" placeholder="Insert last name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $employee->email) }}" placeholder="Insert email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Insert password">
                        <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm password">
                    </div>

                    <div class="form-group">
                        <label for="sub_salons_id">Sub Salon</label>
                        <select name="sub_salons_id" id="sub_salons_id" class="form-control" required>
                            @foreach($sub_salons as $sub_salon)
                                <option value="{{ $sub_salon->id }}" {{ $employee->sub_salons_id == $sub_salon->id ? 'selected' : '' }}>
                                    {{ $sub_salon->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                    <a href="{{ route('employees.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
