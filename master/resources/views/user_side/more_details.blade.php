@extends('layouts.app-user')

@section('content')
<style>
    .paragraph-description {
        font-size: 16px;
        line-height: 1.6;
        color: #333;
        margin-bottom: 1.5rem;
    }

    .paragraph-hours {
        font-size: 16px;
        line-height: 1.6;
        color: #555;
        margin-bottom: 1.5rem;
    }

    .paragraph-info {
        font-size: 16px;
        line-height: 1.6;
        color: #444;
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

    .custom-slider .owl-item {
        text-align: center;
    }

    .custom-slider img {
        transition: transform 0.6s ease;
    }

    .custom-slider img:hover {
        transform: scale(1.04);
    }

    .category-item {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin: 10px;
        text-align: center;
        background-color: #fff;
    }
</style>
<div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover inner-page-cover" style="background-image: url('{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}'); background-size: 100%; background-position: center;" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container" style="position: relative; height: 90%; padding: 0; margin: 0;">
            <div class="text-container" style="position: absolute; bottom: 20px; left: 0; text-align: left; ml-8">
                <div class="col-md-8 " data-aos="fade-up" data-aos-delay="400"> 
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
                        <img src="{{ asset($image->image) }}" alt="Eyebrow Service" class="img-fluid" style="object-fit: cover; height: 300px; width: 100%;">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="row justify-content-center mt-5 mb-5">
        <div class="container text-center my-4">
            <h2>more detils about this salon</h2>
        </div>
    </div>
{{-- <div class="site-section">
    <div class="container"> --}}
        <div class="row mb-5">
            <div class="col-md-7">
                <div class="img-md-fluid">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345091796!2d144.9537353153159!3d-37.81627997975109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11c97d%3A0x5045675218ce6e0!2sMelbourne%20CBD%2C%20Victoria%2C%20Australia!5e0!3m2!1sen!2sus!4v1616011087579!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <div class="col-md-4 align-self-center"> <!-- تعديل عرض العمود الثاني -->
                <h1 class="text-primary">Welcome to {{ $subsalon->name }} salon</h1>
                <p class="paragraph-description mb-4">{{ $subsalon->description }}</p>
                {{-- <p class="paragraph-info mb-4">Our platform offers seamless appointment booking and access to a variety of services, ensuring you find exactly what you need. We pride ourselves on delivering exceptional customer service and high-quality treatments.</p> --}}

                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="bi bi-check"></i> Expert Stylists</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="bi bi-check"></i> Easy Online Booking</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="bi bi-check"></i> Transparent Pricing</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="bi bi-check"></i> Customer Reviews</p>
                    </div>
                </div>
                <a href="{{ route('all-categories', $subsalon) }}" class="search-button">Book Now</a>
            </div>


        </div>
    </div>
</div>
</div>




<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="container text-center my-4">
                <h2>Feedbacks</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-lg-4 text-center mb-5" data-aos="fade-up">
                <img src="https://c0.klipartz.com/pngpicture/355/848/gratis-png-iconos-de-computadora-perfil-de-usuario-cuenta-de-google-s-icono-de-cuenta-thumbnail.png" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">Jean Smith</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ab quas facilis obcaecati non ea, est odit repellat distinctio incidunt, quia aliquam eveniet quod deleniti impedit sapiente atque tenetur porro?</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center mb-5" data-aos="fade-up">
                <img src="https://c0.klipartz.com/pngpicture/355/848/gratis-png-iconos-de-computadora-perfil-de-usuario-cuenta-de-google-s-icono-de-cuenta-thumbnail.png" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">Claire Smith</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ab quas facilis obcaecati non ea, est odit repellat distinctio incidunt, quia aliquam eveniet quod deleniti impedit sapiente atque tenetur porro?</p>
            </div>
            <div class="col-md-6 col-lg-4 text-center mb-5" data-aos="fade-up">
                <img src="https://c0.klipartz.com/pngpicture/355/848/gratis-png-iconos-de-computadora-perfil-de-usuario-cuenta-de-google-s-icono-de-cuenta-thumbnail.png" alt="Image" class="img-fluid w-50 rounded-circle mb-4">
                <h2 class="text-black font-weight-light mb-4">John Smith</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur ab quas facilis obcaecati non ea, est odit repellat distinctio incidunt, quia aliquam eveniet quod deleniti impedit sapiente atque tenetur porro?</p>
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
            autoplayHoverPause: true
        });

        $(".feedback-slider").owlCarousel({
            items: 1,
            loop: true,
            gap: 20,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true
        });
    });
</script>

@endsection
