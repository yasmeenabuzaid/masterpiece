@extends('layouts.app-user')

@section('content')
<style>
    .paragraph-description, .paragraph-hours, .paragraph-info {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        margin-bottom: 1.5rem;
    }

    h1 {
        font-size: 2.5rem;
        color: #222;
        margin-bottom: 1rem;
    }

    h6 {
        font-size: 1.2rem;
        color: #444;
        margin-top: 1rem;
    }

    .search-section {
        margin-top: 20px;
    }

    .search-input {
        width: 80%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .search-button {
        padding: 10px 35px;
        font-size: 16px;
        background-color: #0056b3;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #033367;
    }

    .custom-slider {
        margin-top: 20px;
    }

    .custom-slider img {
        transition: transform 0.6s ease;
        object-fit: cover;
        height: 300px;
        width: 100%;
    }

    .custom-slider img:hover {
        transform: scale(1.04);
    }

    .site-block-feature-7 {
        border-radius: 10px;
        transition: transform 0.3s;
        padding: 20px;
        background-color: #f8f9fa;
        height: 300px;
        width: 300px;
        display: inline-block;
        margin: 10px;
    }

    .site-block-feature-7:hover {
        transform: translateY(-5px);
    }

</style>

<div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover inner-page-cover" style="background-image: url('{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container" style="position: relative; height: 90%; padding: 0; margin: 0;">
            <div class="text-container" style="position: absolute; bottom: 20px; left: 0; text-align: left;">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-white font-weight-light mb-2 display-1">{{ $subsalon->name }}</h2>
                    <div class="search-section">
                        <h4>Location: {{$subsalon->location}}</h4>
                        <h4>Type of this salon: {{$subsalon->type}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-white" style="padding: 0; margin: 0;">
    <div class="container-fluid" style="padding: 0;">
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme custom-slider">
                    @foreach($subsalon->images as $image)
                        <div class="item mb-3">
                            <img src="{{ asset($image->image) }}" alt="Salon Image" class="img-fluid">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="row justify-content-center mb-5 ">
            <div class="col-md-7 text-center">
                <h2 class="site-section-heading font-weight-light">more details for this salon</h2>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-7">
            <div class="img-md-fluid">
                @if($subsalon->map_iframe)
                <iframe src="{{ $subsalon->map_iframe }}" width="100%" height="450" style="border:0;" allowfullscreen loading="lazy"></iframe>
            @else
                {{-- <img src="https://cdni.iconscout.com/illustration/premium/thumb/location-error-404-flash-message-illustration-download-in-svg-png-gif-file-formats--finding-position-navigator-pin-gps-travelling-characters-pack-holidays-illustrations-9001081.png?f=webp" alt="Alternative Image" width="100%" height="450" style="border:0;"> --}}
                <p style="font-size: 20px; color:red;">No map available.</p>
                <p style="font-size: 15px;">
                    Contact the salon at {{ $subsalon->phone }} for location details.
                </p>
            @endif

            </div>
        </div>
        <div class="col-md-4 align-self-center">
            <h1 class="text-primary">Welcome to {{ $subsalon->name }} Salon</h1>
            <p class="paragraph-description mb-4">{{ $subsalon->description }}</p>
            <div class="row gy-2 gx-4 mb-4">
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Expert Stylists</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Easy Online Booking</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Transparent Pricing</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Customer Reviews</p></div>
            </div>
            <a href="{{ route('all-categories', $subsalon) }}" class="search-button">Book Now</a>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-5 ">
            <div class="col-md-7 text-center">
                <h2 class="site-section-heading font-weight-light">Featured Services</h2>
            </div>
        </div>
        <div class="owl-carousel owl-theme custom-slider">
            @foreach($categories as $categorie)
            <div class="item m-2">
                <div class="h-100 p-4 p-lg-5 bg-light site-block-feature-7 d-flex flex-column" style="height: 50px">
                    <span class="icon flaticon-razor display-3 text-primary mb-4 d-block"></span>
                    <h3 class="text-black h4">{{$categorie->name }}</h3>
                    <p>{{$categorie->description }}</p>
                    <p><button>see more</button></p>
                </div>
            </div>
            @endforeach
            {{-- <div class="item m-2">
                <div class="h-100 p-4 p-lg-5 bg-light site-block-feature-7 d-flex flex-column" style="height: 50px">
                    <span class="icon flaticon-shave display-3 text-primary mb-4 d-block"></span>
                    <h3 class="text-black h4">Barber Shave</h3>
                    <p>Sample description for Barber Shave service.</p>
                    <p><strong class="font-weight-bold text-primary">$24</strong></p>
                </div>
            </div> --}}

        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 ">
            <div class="col-md-7 text-center">
                <h2 class="site-section-heading font-weight-light ">feedbacks</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 text-center mb-5">
                <img src="user_image1.jpg" alt="User Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">Jean Smith</h2>
                <p class="mb-4">Great service and friendly staff!</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center mb-5">
                <img src="user_image2.jpg" alt="User Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">Claire Smith</h2>
                <p class="mb-4">Loved the atmosphere and the results!</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center mb-5">
                <img src="user_image3.jpg" alt="User Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">Mike Johnson</h2>
                <p class="mb-4">Definitely coming back again!</p>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
    $(document).ready(function(){
        $(".custom-slider").owlCarousel({
            items: 4,
            loop: true,
            margin: 20,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            nav: true,
            navText: ["<div class='nav-btn prev-btn'><</div>", "<div class='nav-btn next-btn'>></div>"],
            responsive: {
                0: { items: 1 },
                600: { items: 2 },
                1000: { items: 4 }
            }
        });
    });
</script>

<style>

</style>
@endsection
