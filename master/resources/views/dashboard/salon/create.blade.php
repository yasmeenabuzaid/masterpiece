
@extends("layouts.dashboard_master")
@section("headTitle", "One")
@section("content")

    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">create a new salon</h4>
                    <form class="forms-sample" action="{{ route('salons.store') }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="name">salon name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="insert salon name" required>
                        </div>
                        {{-- <div class="form-group">
                            <label for="address">salon address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="insert salon address" required>
                        </div> --}}
                        <div class="form-group">
                            <label for="description">salon description</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="insert salon description" required>
                        </div>

                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" name="image" id="fileUpload" class="form-control">
                        </div>


                        <button type="submit"  class="btn btn-gradient-success  btn-fw">save</button>
                        <button class="btn btn-light">back to list</button>
                    </form>
                </div>
            </div>
        </div>
@endsection

