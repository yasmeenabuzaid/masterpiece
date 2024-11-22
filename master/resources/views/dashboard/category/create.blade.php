@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
@extends("layouts.dashboard_master")
@section("headTitle", "Create Category")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Category</h4>

                <form class="forms-sample" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category Name -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert category name" required>
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                    </div>

                    <!-- For SuperAdmin: Show all SubSalons -->
                    @if (auth()->user()->isSuperAdmin())
                        <div class="form-group">
                            <label for="sub_salons_id">Select SubSalon Address</label>
                            <select class="form-control form-control-sm" name="sub_salons_id" id="sub_salons_id" required>
                                @foreach ($subSalon as $subsalon)
                                    <option value="{{ $subsalon->id }}">{{ $subsalon->location }}</option>
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
                                    <option value="{{ $subsalon->id }}">{{ $subsalon->address }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-gradient-success btn-fw">Submit New Category</button>

                    <!-- Cancel Button -->
                    <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@endif
