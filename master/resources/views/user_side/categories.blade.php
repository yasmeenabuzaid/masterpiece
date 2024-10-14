@extends('layouts.app-user')

@section('content')
<style>
    /* .container {
        display: flex;
        flex-direction: column;
        align-items: center;

    } */
    .card {
        background-color: rgb(255, 255, 255);
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin: 10px;
        width: 100%;
        height: auto;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        /* gap: 90px */
         }

    .card h3 {
        margin: 0;
        font-size: 1.8em;
        color: #333;
    }
    .card p {
        margin: 5px 0 0;
        font-size: 1em;
        color: #666;
    }
    .arrow-button {
        background: none;
        border: #1e1e1e solid 2px;
        font-size: 1.5em;
        border-radius: 200px;
        width: 50px;
        height: 50px;
        cursor: pointer;
        color: #1e1e1e;
        transition: color 0.3s;
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .arrow-button:hover {
        color: #343434;
    }
    .text-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .map {
    display: flex;
    align-items: center;
    /* margin: 0px 0; */
  align-self: center;
    align-content: center;
    justify-content: center
    /* justify-content: space-around */
}

.map-step {
    background-color: #fff;
    border: #000000 solid 2px;
    font-size: 1em;
    width: 150px;
    height: 50px;
    cursor: pointer;
    color: #1e1e1e;
    transition: color 0.3s, background-color 0.3s, transform 0.2s;
    border-radius: 10px;
    padding: 10px;
    text-align: center;
    /* margin: 0 5px; */
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-step i {
    margin-right: 5px;
}

.map-step:hover {
    background-color: rgba(255, 105, 180, 0.2);
    transform: scale(1.05);
}

.map-step:hover {
    background-color: #e6e6e6;

}

.map-step.active {
    background-color: #1e1e1e;
    color: white;
    font-weight: bold;
}
.step-divider {
    margin: 0 10px;
    font-size: 1.5em;
    color: #ccc;
}
.step-divider{
    font-weight: bold;
    color: #000000

}
</style>
<div class="container-xxl py-5">
    <div class="container">

        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            {{-- <h6 class="section-title bg-white text-center text-primary px-3">categories</h6> --}}
            <h1 class="mb-5">all categories</h1>
        </div>

        <div class="map">

            <button class="map-step active">
                <i class="fa-solid fa-list"></i> Select Category
            </button>
            <span class="step-divider">---------</span>
            <button class="map-step">
                <i class="fa-solid fa-cogs"></i> Select Service
            </button>
            <span class="step-divider">---------</span>
            <button class="map-step">
                <i class="fa-solid fa-calendar-check"></i> Booking
            </button>
            <span class="step-divider">---------</span>
            <button class="map-step">
                <i class="fa-solid fa-calendar-check"></i> Booking
            </button>
        </div>
        </div>
        <br>
<div class="container">
    @foreach($categories as $categorie)
    <div class="card">
        <div class="text-container">
            <h3>{{ ($categorie->name) }}</h3>
            <p>{{ ($categorie->description) }}</p>
        </div>
        <div>
        <a href="{{ route('all-services', $categorie) }}"">
        <button class="arrow-button"><i class="fa-solid fa-arrow-right"></i></button>
    </a>
    </div>
    </div>
    @endforeach
    {{-- <div class="card">
        <div class="text-container">
            <h3>Health and Wellness</h3>
            <p>Discover tips and guidelines for maintaining your health and caring for your mental well-being.</p>
        </div>
        <button class="arrow-button"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
    <div class="card">
        <div class="text-container">
            <h3>Travel and Adventures</h3>
            <p>Enjoy beautiful travel destinations and the best travel experiences around the world.</p>
        </div>
        <button class="arrow-button"><i class="fa-solid fa-arrow-right"></i></button>
    </div>
    <div class="card">
        <div class="text-container">
            <h3>Arts and Culture</h3>
            <p>Explore the fine arts and diverse cultures through events and exhibitions.</p>
        </div>
        <button class="arrow-button"><i class="fa-solid fa-arrow-right"></i></button>
    </div> --}}
</div>
</div>
</div>

@endsection
