@extends('layouts.dashboard_master')

@section('headTitle', 'Create Employee')

@section('content')
<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create castomor</h4>
                <form class="forms-sample" action="{{ route('castomors.store') }}" method="POST" >
                    @csrf

                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Insert first name" required>

                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Insert last name"  required>

                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Insert email"  required>

                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Insert password" required>

                    </div>






                    <button type="submit" class="btn btn-gradient-primary me-2">Create</button>
                    <a href="{{ route('castomors.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
