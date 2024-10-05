@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
    @extends('layouts.dashboard_master')

    @section('content')
        <h4 class="card-title">Create Service</h4>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Service Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter service name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" placeholder="Enter service description"></textarea>
            </div>

            <div class="form-group">
                <label for="sub_salons_id">Sub Salon</label>
                <select name="sub_salons_id" id="sub_salons_id" class="form-control" required>
                    @foreach($sub_salons as $sub_salon)
                        <option value="{{ $sub_salon->id }}">
                            {{ $sub_salon->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categories_id">Category</label>
                <select id="categories_id" name="categories_id" class="form-control" required>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                    @endforeach
                </select>
            </div>

            @if(auth()->user()->isOwner())
                <input type="hidden" name="users_id" value="{{ auth()->user()->id }}">
                <div class="form-group">
                    <label for="owner">Owner</label>
                    <input type="text" class="form-control" id="owner" value="{{ auth()->user()->name }}" readonly>
                </div>
            @else
                <div class="form-group">
                    <label for="users_id">Owners</label>
                    <select class="form-control form-control-sm" name="users_id" id="users_id" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="submit" class="btn btn-gradient-primary me-2">Create Service</button>
            <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
        </form>
    @endsection
@endif
