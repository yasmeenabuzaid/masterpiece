@extends('layouts.app-user')

@section('content')

<style>


    .filter-form {
        display: flex;
        justify-content: space-between;
        gap: 15px;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
    }

    .filter-form select,
    .filter-form input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 200px;
        transition: all 0.3s ease;
    }

    .filter-form select:focus,
    .filter-form input:focus {
        border-color: #007bff;
        outline: none;
    }

    .filter-form button {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .filter-form button:hover {
        background-color: #0056b3;
    }

    .media {
        min-height: 550px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .media img {
        width: 100%;
        height: 190px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }

    .media-body {
        padding: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .media-body h6 {
        margin: 10px 0;
        font-size: 18px;
    }

    .media-body p {
        flex-grow: 1;
        margin: 10px 0;
    }

    .media-body .btn {
        margin-top: 15px;
    }

    .btn-group .btn {
        margin: 5px;
        border-radius: 5px;
        padding: 10px 20px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        font-size: 14px;
        color: #333;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn-group .btn:hover,
    .btn-group .btn.active {
        background-color: #007bff;
        color: #fff;
    }

</style>


<div class="container">
        <div class="row justify-content-center element-animate">
            <div class="col-md-8 text-center" style="margin-top: 40px">
                <h2 class="text-uppercase heading border-bottom mb-4">Our salons</h2>
                <p class="mb-0 lead">Find your perfect salon easily! Use our filters by type, location, or name to quickly discover and book the ideal spot for you.</p>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="filter-form">
                    <form method="GET" action="{{ route('more_subsalons') }}" class="d-flex justify-content-between w-100 gap-3">
                        <div class="btn-group" role="group" aria-label="Salon Type Filter">
                            <button type="submit" name="type" value="" class="btn {{ request('type') == '' ? 'active' : '' }}">All Salons</button>
                            <button type="submit" name="type" value="women" class="btn {{ request('type') == 'women' ? 'active' : '' }}">Women</button>
                            <button type="submit" name="type" value="men" class="btn {{ request('type') == 'men' ? 'active' : '' }}">Men</button>
                            <button type="submit" name="type" value="mixed" class="btn {{ request('type') == 'mixed' ? 'active' : '' }}">Mixed</button>
                        </div>

                        <select name="governorate" class="btn">
                            <option value="">All Governorates</option>
                            @foreach (['Amman', 'Zarqa', 'Irbid', 'Ajloun', 'Jerash', 'Madaba', 'Mafraq', 'Karak', 'Tafilah', 'Ma\'an', 'Aqaba'] as $governorate)
                                <option value="{{ $governorate }}" {{ request('governorate') == $governorate ? 'selected' : '' }}>{{ $governorate }}</option>
                            @endforeach
                        </select>

                        <input type="text" name="name" class="btn " placeholder="Search by Salon Name" value="{{ request('name') }}">

                        <button type="submit" class="btn">Filter</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row element-animate">
            @forelse ($subsalons->chunk(4) as $chunkedSubsalons)
                <div class="row">
                    @foreach ($chunkedSubsalons as $subsalon)
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                            <div class="media d-block media-custom text-left">
                                <img src="{{ $subsalon->image }}" alt="Image Placeholder" class="img-fluid" style="width: 100%; height: 270px; object-fit: cover;">
                                <div class="media-body">
                                    <div style="display: flex; align-items: center; justify-content:start;">
                                        <a href="#" class="text-black" style="display: flex; align-items: center;">
                                            <img src="{{ $subsalon->salon->image ?? 'image not found' }}" alt="Salon Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;margin-button:30px">
                                        </a>
                                        <br>

                                        <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between;">
                                        <span><strong>{{ $subsalon->salon->name ?? 'No Salon Available' }}</strong> </span>
                                        <span>Location:{{ $subsalon->location ?? 'Not Available' }}</span>
                                    </div>
                                </div>
                                <br>
                                <div style="margin-top: 15px">
                                <span class="meta-post">{{ $subsalon->type}} salon</span>

                                    <p>{{ Str::limit($subsalon->description, 35) }}</p>
                                </div>

                                    <p class="clearfix" >
                                        <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @empty
                <div class="col-12 text-center d-flex justify-content-center align-items-center" style="height: 400px;">
                    <div class="no-salons-content">
                        <img src="https://unsplash-assets.imgix.net/empty-states/photos.png" alt="No salons found" class="no-salons-image" style="max-width: 50%; height: auto;">
                        <p class="no-salons-message" style="font-size: 18px; color: #666;">No salons found. But don't worry, there are many other amazing salons waiting for you!</p>
                    </div>
                </div>
            @endforelse
        </div>
        </div>

    </section>

@endsection
