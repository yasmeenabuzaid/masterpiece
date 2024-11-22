@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
@extends("layouts.dashboard_master")
@section("headTitle", "Edit Category")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Category</h4>

                <form class="forms-sample" action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" placeholder="Insert category name" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" value="{{ old('description', $category->description) }}" placeholder="Description" required>
                    </div>

                    <!-- For SuperAdmin: Show all SubSalons -->
                    @if (auth()->user()->isSuperAdmin())
                        <div class="form-group">
                            <label for="sub_salons_id">Select SubSalon Address</label>
                            <select class="form-control form-control-sm" name="sub_salons_id" id="sub_salons_id" required>
                                @foreach ($subSalon as $subsalon)
                                    <option value="{{ $subsalon->id }}" {{ $subsalon->id == $category->sub_salons_id ? 'selected' : '' }}>
                                        {{ $subsalon->location }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @elseif (auth()->user()->isOwner())
                        <!-- For Owner: Show only SubSalons associated with the Owner's Salon -->
                        <input type="hidden" name="salon_id" value="{{ auth()->user()->salons_id }}">

                        <div class="form-group">
                            <label for="sub_salons_id">Select SubSalon Address</label>
                            <select class="form-control form-control-sm" name="sub_salons_id" id="sub_salons_id" required>
                                @foreach ($subSalon as $subsalon)
                                    <option value="{{ $subsalon->id }}" {{ $subsalon->id == $category->sub_salons_id ? 'selected' : '' }}>
                                        {{ $subsalon->address }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-gradient-success btn-fw">Update Category</button>

                    <!-- Cancel Button -->
                    <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@endif
