
@extends("layouts.dashboard_master")
@section("headTitle", "Edit Salon")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">edit this salon</h4>

                <form action="{{ route('salons.update', $salon->id) }}" method="POST" enctype="multipart/form-data">
                    {{-- enctype="multipart/form-data" -> يسمح بإرسال أنواع متعددة من البيانات --}}
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Salon Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert salon name" value="{{ old('name', $salon->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="address">Salon Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ old('address', $salon->address) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Salon description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{ old('description', $salon->description) }}" required>
                    </div>

                

                    <div class="form-group">
                        <label for="image">File Upload</label>
                        <input type="file" name="image" id="fileUpload" class="form-control">
                        @if($salon->image)
                            <img src="{{ asset($salon->image) }}" alt="Current Image" style="max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit Update</button>
                    <a href="{{ route('salons.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

