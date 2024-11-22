@extends('layouts.dashboard_master')
@section('headTitle', 'One')
@section('content')

    <div class="nav-profile-text d-flex flex-column">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h3><i class="fas fa-building me-2"></i>- Create a New Salon</h3>
                    <br>
                    <p>⭐ This information should be general and applicable to all your subsidiary beauty salons.</p>

                    <hr>
                    <br>



                    <form class="forms-sample" action="{{ route('salons.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="name">Salon Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="Insert salon name" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">About This Salon</label>
                            <input type="text" class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" placeholder="Insert salon description" required>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Upload Logo for Your Salon</label>
                            <input type="file" name="image" id="fileUpload"
                                class="form-control @error('image') is-invalid @enderror" required>
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-custom ">Save</button>
                        <button type="button" class="btn btn-light" onclick="window.history.back();">Back to List</button>
                    </form>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
