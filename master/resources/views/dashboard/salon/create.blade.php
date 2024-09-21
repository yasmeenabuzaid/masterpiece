
@extends("layouts.dashboard_master")
@section("headTitle", "One")
@section("content")

    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">create salon</h4>
                    <form class="forms-sample" action="{{ route('salons.store') }}" method="POST" enctype="multipart/form-data">
                        {{-- enctype="multipart/form-data" -> بتخليني ابعت انواع داتا مختلفه --}}

                        @csrf
                        <div class="form-group">
                            <label for="name">salon name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="insert salon name" required>
                        </div>
                        <div class="form-group">
                            <label for="address">salon address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="address" required>
                        </div>
                        <div class="form-group">
                            <label for="description">salon description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="description" required>
                        </div>
                     
                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" name="image" id="fileUpload" class="form-control">
                        </div>


                        <button type="submit" class="btn btn-gradient-primary me-2">Submit new salon</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

