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
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert category name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Upload Image or Logo for Your Salon</label>
                        <input type="file" name="image" id="fileUpload"
                            class="form-control @error('image') is-invalid @enderror" required>
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
                                    <option value="{{ $subsalon->id }}">{{ $subsalon->address }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label for="user_id">Owners</label>
                            <select class="form-control form-control-sm" name="user_id" id="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    @else
                        <input type="hidden" name="sub_salons_id" value="{{ auth()->user()->sub_salons_id }}">
                        {{-- <input type="hidden" name="user_id" value="{{ auth()->user()->id }}"> --}}
                    @endif

                    <button type="submit"  class="btn btn-gradient-success  btn-fw">Submit New Category</button>
                    <button class="btn btn-light" type="button" onclick="window.history.back();">Cancel</button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@endif
