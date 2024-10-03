@extends("layouts.dashboard_master")
@section("content")

@if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))

<div class="nav-profile-text d-flex flex-column">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Subcategory</h4>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="forms-sample" action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Insert subcategory name" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" required>
                    </div>

                    @if (auth()->user()->isSuperAdmin())
                        <div class="form-group">
                            <label for="categories_id">Category</label>
                            <select id="categories_id" name="categories_id" class="form-control" required>
                                <option value="">Select a category</option>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="salons_id">Salon</label>
                            <select class="form-control form-control-sm" name="salons_id" id="salons_id" required>
                                @foreach ($salons as $salon)
                                    <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @elseif (auth()->user()->isOwner())
                        {{-- هنا يمكن إضافة أي عناصر أخرى خاصة بالمالك إذا لزم الأمر --}}
                    @endif

                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                    <a href="{{ route('subcategories.index') }}" class="btn btn-light">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
