@extends('layouts.dashboard_master')
@section('headTitle', 'Edit SubSalon')
@section('content')

    <div class="form-group">
        <label>Current Images</label><br>
        <div class="row">
            @foreach ($Images as $Image)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset($Image->image) }}" class="img-fluid rounded" alt="this image was deleted"
                        style="height: 200px; object-fit: cover; width: 100%;" loading="lazy">
                    <form action="{{ route('images.destroy', $Image->id) }}" method="POST" title="Delete">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-icon btn-youtube" aria-label="Delete Image"
                            onclick="confirmDeletion(event, '{{ route('images.destroy', $Image->id) }}')"
                            style="margin: 10px;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit SubSalon</h4>
                    <form class="forms-sample" action="{{ route('subsalons.update', $subsalon->id) }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="image">edit Image for Your SubSalon</label>
                            <input type="file" name="image" id="fileUpload" class="form-control">
                            The old image:
                            @if ($subsalon->image)
                                <img src="{{ asset($subsalon->image) }}" alt="Current Image"
                                    style="max-width: 100px; margin-top: 10px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description"
                                value="{{ old('description', $subsalon->description) }}" placeholder="Insert description"
                                required>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $subsalon->address) }}" placeholder="Insert address" required>
                            @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ old('location', $subsalon->location) }}" placeholder="Insert location" required>
                            @error('location')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- iframe Location -->
                        <div class="form-group">
                            <label for="map_iframe">iframe Location</label>
                            <textarea name="map_iframe" class="form-control" placeholder="iframe Location" required>{{ old('map_iframe', $subsalon->map_iframe) }}</textarea>
                            @error('map_iframe')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salon Selection for Super Admin or Hidden for Owner -->
                        @if (auth()->user()->isSuperAdmin())
                            <label for="salon_id">Salon</label>
                            <select class="form-control" name="salon_id" id="salon_id" required>
                                @foreach ($salons as $salon)
                                    <option value="{{ $salon->id }}"
                                        {{ old('salon_id', $subsalon->salon_id) == $salon->id ? 'selected' : '' }}>
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

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $subsalon->phone) }}" placeholder="Insert phone" required>
                            @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="images">Upload the new Image for Your SubSalon</label>
                            <input type="file" name="images[]" id="images" class="form-control" multiple />
                            <small class="form-text text-muted">Please upload images in JPEG, PNG, or GPJ formats .</small>
                            @error('images.*')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Working Days -->
                        <div class="form-group">
                            <label for="working_days">Working Days</label>
                            <select class="form-control" name="working_days[]" id="working_days" multiple required>
                                @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                    <option value="{{ $day }}"
                                        {{ in_array($day, $workingDays) ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            <small>Select multiple days by holding down the Ctrl (Windows) or Command (Mac) key.</small>
                            @error('working_days')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Opening Hours Start -->
                        <div class="form-group">
                            <label for="opening_hours_start">Opening Hours Start:</label>
                            <div class="form-inline">
                                <select name="opening_hours_start_hour" id="opening_hours_start_hour" required>
                                    @for ($hour = 1; $hour <= 12; $hour++)
                                        <option value="{{ $hour }}"
                                            {{ date('h', strtotime($subsalon->opening_hours_start)) == $hour ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $hour) }}</option>
                                    @endfor
                                </select>

                                <select name="opening_hours_start_minute" id="opening_hours_start_minute" required>
                                    @for ($minute = 0; $minute < 60; $minute += 5)
                                        <option value="{{ $minute }}"
                                            {{ date('i', strtotime($subsalon->opening_hours_start)) == $minute ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $minute) }}</option>
                                    @endfor
                                </select>

                                <select name="opening_hours_start_ampm" id="opening_hours_start_ampm" required>
                                    <option value="AM"
                                        {{ date('A', strtotime($subsalon->opening_hours_start)) == 'AM' ? 'selected' : '' }}>
                                        AM</option>
                                    <option value="PM"
                                        {{ date('A', strtotime($subsalon->opening_hours_start)) == 'PM' ? 'selected' : '' }}>
                                        PM</option>
                                </select>
                            </div>
                        </div>

                        <!-- Opening Hours End -->
                        <div class="form-group">
                            <label for="opening_hours_end">Opening Hours End:</label>
                            <div class="form-inline">
                                <select name="opening_hours_end_hour" id="opening_hours_end_hour" required>
                                    @for ($hour = 1; $hour <= 12; $hour++)
                                        <option value="{{ $hour }}"
                                            {{ date('h', strtotime($subsalon->opening_hours_end)) == $hour ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $hour) }}</option>
                                    @endfor
                                </select>

                                <select name="opening_hours_end_minute" id="opening_hours_end_minute" required>
                                    @for ($minute = 0; $minute < 60; $minute += 5)
                                        <option value="{{ $minute }}"
                                            {{ date('i', strtotime($subsalon->opening_hours_end)) == $minute ? 'selected' : '' }}>
                                            {{ sprintf('%02d', $minute) }}</option>
                                    @endfor
                                </select>

                                <select name="opening_hours_end_ampm" id="opening_hours_end_ampm" required>
                                    <option value="AM"
                                        {{ date('A', strtotime($subsalon->opening_hours_end)) == 'AM' ? 'selected' : '' }}>
                                        AM</option>
                                    <option value="PM"
                                        {{ date('A', strtotime($subsalon->opening_hours_end)) == 'PM' ? 'selected' : '' }}>
                                        PM</option>
                                </select>
                            </div>
                        </div>

                        <!-- Type of SubSalon -->
                        <div class="form-group">
                            <label for="type">Type of SubSalon</label>
                            <select class="form-control" name="type" id="type" required>
                                <option value="women" {{ $subsalon->type == 'women' ? 'selected' : '' }}>Women Only
                                </option>
                                <option value="men" {{ $subsalon->type == 'men' ? 'selected' : '' }}>Men Only</option>
                                <option value="mixed" {{ $subsalon->type == 'mixed' ? 'selected' : '' }}>Mixed</option>
                            </select>
                        </div>

                        <!-- Availability -->
                        <div class="form-group">
                            <label for="is_available">Available</label>
                            <input type="checkbox" id="is_available" name="is_available" value="1"
                                {{ $subsalon->is_available ? 'checked' : '' }}>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn btn-custom ">Update</button>
                        <button type="button" class="btn btn-light" onclick="window.history.back();">Back to
                            List</button>

                        <!-- Display Errors -->
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

    <script>
        function confirmDeletion(event, url) {
            event.preventDefault(); // Prevent the form from submitting immediately
            if (confirm('Are you sure you want to delete this image?')) {
                // If confirmed, proceed to submit the form
                event.target.closest('form').submit();
            }
        }
    </script>

@endsection
