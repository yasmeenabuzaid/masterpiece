@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
@extends("layouts.dashboard_master")
@section("headTitle", "Edit Category")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Category</h4>

                <form class="forms-sample" action="{{ route('categories.update', $categorie->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- إضافة هذا السطر لتحديد نوع الطلب كـ PUT -->

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert category name" value="{{ old('name', $categorie->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="{{ old('description', $categorie->description) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image">Upload New Image or Logo for Your Salon (optional)</label>
                        <input type="file" name="image" id="fileUpload" class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <p class="mt-2 text-muted">Preferably upload images with dimensions around 1920x1080.</p>
                    </div>

                    @if (auth()->user()->isSuperAdmin())
                        <div class="form-group">
                            <label for="sub_salons_id">Select SubSalon Address</label>
                            <select class="form-control form-control-sm" name="sub_salons_id" id="sub_salons_id" required>
                                @foreach ($subsalons as $subsalon)
                                    <option value="{{ $subsalon->id }}" {{ $subsalon->id == $categorie->sub_salons_id ? 'selected' : '' }}>
                                        {{ $subsalon->address }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <input type="hidden" name="sub_salons_id" value="{{ auth()->user()->sub_salons_id }}">
                    @endif

                    <button type="submit" class="btn btn-gradient-success btn-fw">Update Category</button>
                    <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@endif
