@extends("layouts.dashboard_master")
@section("headTitle", "One")
@section("content")

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Category</h4>

                @if (auth()->user()->isSuperAdmin())
                    <form class="forms-sample" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Insert category name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                        </div>

                        <div class="form-group">
                            <label for="salons_id">Salon</label>
                            <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                                @foreach ($salons as $salon)
                                    <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit New Category</button>
                        <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>
                    </form>
                @elseif (auth()->user()->isOwner())
                    <form class="forms-sample" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Insert category name" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                        </div>

                        <input type="hidden" name="salons_id" value="{{ auth()->user()->salon_id }}">

                        <button type="submit" class="btn btn-gradient-primary me-2">Submit New Category</button>
                        <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>
                    </form>
                @else
                    <p>You do not have permission to create categories. Please contact an super admin .</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
