@extends("layouts.dashboard_master")
@section("content")

    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">create category</h4>
                    <form class="forms-sample" action="{{ route('subcategories.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- enctype="multipart/form-data" -> بتخليني ابعت انواع داتا مختلفه --}}

                        @csrf
                        <div class="form-group">
                            <label for="name"> name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="insert salon name" required>
                        </div>
   
                        <div class="form-group">
                            <label for="description"> description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="description" required>
                        </div>
                        <div class="form-group">
                            <label for="categories_id">Category</label>
                            <select id="categories_id" name="categories_id" class="form-control" required>
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-gradient-primary me-2">Submit new salon</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
