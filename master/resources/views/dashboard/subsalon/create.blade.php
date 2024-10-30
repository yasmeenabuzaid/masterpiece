@extends('layouts.dashboard_master')
@section('headTitle', 'Create SubSalon')
@section('content')

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create SubSalon</h4>
                <form class="forms-sample" action="{{ route('subsalons.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert name" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Insert address" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Insert description" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Insert location" required>
                    </div>
                    <div class="form-group">
                        <label for="iframe">iframe Location</label>
                        <textarea name="map_iframe" placeholder="iframe Location" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert phone" required>
                    </div>

                    <div class="form-group">
                        <label for="images">Choose Featured Works of the Salon</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple />
                    </div>

                    <label for="salon_id">Salon</label>
                    <select class="form-control" name="salon_id" id="salon_id" required>
                        @foreach ($salons as $salon)
                            <option value="{{ $salon->id }}" {{ old('salon_id') == $salon->id ? 'selected' : '' }}>
                                {{ $salon->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('salon_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror

                    <!-- Working Days -->
                    <div class="form-group">
                        <label for="working_days">Working Days</label>
                        <select class="form-control" name="working_days[]" id="working_days" multiple required>
                            @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                <option value="{{ $day }}">{{ $day }}</option>
                            @endforeach
                        </select>
                        <small>Select multiple days by holding down the Ctrl (Windows) or Command (Mac) key.</small>
                    </div>

                    <div class="form-group">
                        <label for="opening_hours_start">Opening Hours From:</label>
                        <select name="opening_hours_start" id="opening_hours_start" class="form-control">
                            @foreach(range(1, 12) as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                            @endforeach
                        </select>
                        <select name="opening_hours_start_period" id="opening_hours_start_period" class="form-control">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="opening_hours_end">To:</label>
                        <select name="opening_hours_end" id="opening_hours_end" class="form-control">
                            @foreach(range(1, 12) as $hour)
                                <option value="{{ $hour }}">{{ $hour }}</option>
                            @endforeach
                        </select>
                        <select name="opening_hours_end_period" id="opening_hours_end_period" class="form-control">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="type">Type of SubSalon</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="women">Women Only</option>
                            <option value="men">Men Only</option>
                            <option value="mixed">Mixed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Create</button>
                    <a href="{{ route('subsalons.index') }}" class="btn btn-light">Cancel</a>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
