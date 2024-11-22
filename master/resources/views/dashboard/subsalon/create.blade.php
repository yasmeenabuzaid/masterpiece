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
                        <label for="image">Upload Image for Your SubSalon</label>
                        <input type="file" name="image" id="fileUpload"
                            class="form-control @error('image') is-invalid @enderror" required>
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Insert description" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Insert address" required>
                    </div>

                    <div class="form-group">
                        <label for="location">Governorates</label>
                        <select class="form-control" id="location" name="location" required>
                            @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                                <option value="{{ $governorate }}" {{ old('location') == $governorate ? 'selected' : '' }}>
                                    {{ $governorate }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="iframe">iframe Location</label>
                        <textarea name="map_iframe" placeholder="iframe Location" required></textarea>
                    </div>

                    @if (auth()->user()->isSuperAdmin())
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
                    @elseif (auth()->user()->isOwner())
                        <input type="hidden" name="salon_id" value="{{ auth()->user()->salons_id }}">
                    @endif

                    <br>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Insert phone" required>
                    </div>

                    <div class="form-group">
                        <label for="images">Choose Featured images of this SubSalon</label>
                        <input type="file" name="images[]" id="images" class="form-control" multiple />
                        <small class="form-text text-muted">Please upload images in JPEG, PNG, or GPJ formats .</small>
                    </div>

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

                    <!-- Opening Hours Start -->
                    <label for="opening_hours_start_hour">Opening Hours Start:</label>
                    <select name="opening_hours_start_hour" id="opening_hours_start_hour">
                        @for ($hour = 1; $hour <= 12; $hour++)
                            <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}</option>
                        @endfor
                    </select>

                    <select name="opening_hours_start_minute" id="opening_hours_start_minute">
                        @for ($minute = 0; $minute < 60; $minute += 5)
                            <option value="{{ sprintf('%02d', $minute) }}">{{ sprintf('%02d', $minute) }}</option>
                        @endfor
                    </select>

                    <select name="opening_hours_start_ampm" id="opening_hours_start_ampm">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <br><br>

                    <!-- Opening Hours End -->
                    <label for="opening_hours_end_hour">Opening Hours End:</label>
                    <select name="opening_hours_end_hour" id="opening_hours_end_hour">
                        @for ($hour = 1; $hour <= 12; $hour++)
                            <option value="{{ $hour }}">{{ sprintf('%02d', $hour) }}</option>
                        @endfor
                    </select>

                    <select name="opening_hours_end_minute" id="opening_hours_end_minute">
                        @for ($minute = 0; $minute < 60; $minute += 5)
                            <option value="{{ sprintf('%02d', $minute) }}">{{ sprintf('%02d', $minute) }}</option>
                        @endfor
                    </select>

                    <select name="opening_hours_end_ampm" id="opening_hours_end_ampm">
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                    </select>
                    <br><br>

                    <div class="form-group">
                        <label for="type">Type of SubSalon</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="women">Women Only</option>
                            <option value="men">Men Only</option>
                            <option value="mixed">Mixed</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="is_available">Available</label>
                        <input type="checkbox" id="is_available" name="is_available" value="1">
                    </div>

                    <button type="submit" class="btn btn-custom ">Save</button>
                    <button type="button" class="btn btn-light" onclick="window.history.back();">Back to List</button>

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
