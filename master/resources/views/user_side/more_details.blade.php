@extends('layouts.app-user')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
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
    .custom-slider-salon {
    margin-top: 20px;
}

.custom-slider-salon {
    margin-top: 20px;
}

.custom-slider-salon .item {
    display: flex;
    justify-content: center; /* محاذاة العناصر في المنتصف */
}

.custom-slider-salon img {
    transition: transform 0.6s ease;
    object-fit: cover;
    height: 300px; /* تأكد من ارتفاع ثابت للصورة */
    width: 100%; /* استخدم العرض الكامل */
}

.custom-slider-salon img:hover {
    transform: scale(1.04);
}

.site-block-feature-7 {
    border-radius: 10px;
    transition: transform 0.3s;
    background-color: #f8f9fa;
    height: 300px; /* تأكد من توافقه مع ارتفاع الصورة */
    margin: 10px; /* مسافة بين الصور */
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
                {{-- <div class="owl-carousel owl-theme custom-slider-salon">
                    @foreach($subsalon->images as $image)
                        <div class="item mb-3">
                            <div class="site-block-feature-7">
                                <img src="{{ asset($image->image) }}" alt="Salon Image" class="img-fluid">
                            </div>
                        </div>
                    @endforeach
                </div> --}}


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
            <div class="owl-carousel owl-theme custom-slider-salon">
                @foreach($subsalon->images as $image)
                    <div class="item mb-3">
                        <div class="site-block-feature-7">
                            <img src="{{ asset($image->image) }}" alt="Salon Image" class="img-fluid" style="width: 180px">
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="col-md-4 align-self-center">
            <h1 class="text-primary">Welcome to {{ $subsalon->name }} Salon</h1>
            <p class="paragraph-description mb-4">{{ $subsalon->description }}</p>
            <div class="row gy-2 gx-4 mb-4">
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-star"></i>
                    Expert Stylists</p></div>
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
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2 class="site-section-heading font-weight-light">Feedbacks</h2>
            </div>
        </div>
        <div class="owl-carousel owl-theme feedback-slider">
            @foreach($feeds as $feed)
                <div class="item text-center mb-5">
                    <img src="{{ $feed->user->image ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjhNf9omxKz2fKDDGINL73mREg3C9H29w8NObPfh7Is55R63Tjp7GFsZvOeq-qXYDltDg&usqp=CAU' }}" alt="User Image" class="img-fluid w-50 rounded-circle mb-4">
                    <h3 class="text-black font-weight-light mb-3">{{ $feed->feedback }}</h3>
                    <div class="rating mb-4">
                        <span class="fs-18 cl11">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="bi {{ $i <= $feed->rating ? 'bi-star-fill' : 'bi-star' }}" style="color: #f9ba48;"></i>
                            @endfor
                        </span>
                    </div>
                    <p class="mb-4">Rating: {{ $feed->rating }}</p>
                </div>
            @endforeach
        </div>



        <!-- Feedback Submission Section -->
        @if(Auth::check())
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center">
                    <h2 class="site-section-heading font-weight-light">Add Your Feedback</h2>
                    <form action="{{ route('feeds.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="feedback" class="form-control" rows="3" placeholder="Write your feedback here" required></textarea>
                        </div>
                        <div class="form-group">
                            <div class="flex-w flex-m p-t-50 p-b-23">
                                <span class="stext-102 cl3 m-r-16">
                                    Your Rating *
                                </span>

                                <span class="wrap-rating fs-18 cl11 pointer">
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(1)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(2)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(3)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(4)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(5)"></i>
                                    <input class="dis-none" type="hidden" name="rating" id="rating" value="" required>
                                </span>
                            </div>

                            <script>
                                function setRating(rating) {
                                    document.getElementById('rating').value = rating;
                                    // Update star visuals based on selected rating
                                    const stars = document.querySelectorAll('.item-rating');
                                    stars.forEach((star, index) => {
                                        if (index < rating) {
                                            star.classList.add('bi-star-fill'); // Filled star class
                                            star.classList.remove('bi-star'); // Outline star class
                                        } else {
                                            star.classList.add('bi-star'); // Outline star class
                                            star.classList.remove('bi-star-fill');
                                        }
                                    });
                                }
                            </script>
                        </div>

                        <input type="hidden" name="users_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="sub_salons_id" value="{{ $subsalon->id }}">
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-warning text-center">
                <h4>Please log in to add your feedback!</h4>
                <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
            </div>
        @endif
    </div>
</div>


<style>
.star {
    font-size: 2rem;
    color: #ddd;
    margin: 0 5px;
    transition: color 0.2s;
}

.star.selected {
    color: gold;
}

</style>

<script>
document.querySelectorAll('.star').forEach(star => {
    star.addEventListener('click', () => {
        const ratingValue = star.getAttribute('data-value');
        document.getElementById('rating-value').value = ratingValue;

        // Remove 'selected' class from all stars
        document.querySelectorAll('.star').forEach(s => {
            s.classList.remove('selected');
        });

        // Add 'selected' class to the clicked star and all previous stars
        star.classList.add('selected');
        let previousStar = star;
        while (previousStar = previousStar.previousElementSibling) {
            previousStar.classList.add('selected');
        }
    });
});
$(document).ready(function(){
    $(".custom-slider").owlCarousel({
        items: 1, // Show only one feedback at a time
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        navText: ["<div class='nav-btn prev-btn'><</div>", "<div class='nav-btn next-btn'>></div>"],
    });
});

</script>







<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
$(document).ready(function(){
    // Carousel for salon images
    $(".custom-slider-salon").owlCarousel({
        items: 1, // عرض صورة واحدة في نفس الوقت
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        navText: ["<div class='nav-btn prev-btn'><</div>", "<div class='nav-btn next-btn'>></div>"],
        responsive: {
            0: { items: 1 }, // صورة واحدة على الشاشات الصغيرة
            600: { items: 1 }, // صورة واحدة على الشاشات المتوسطة
            1000: { items: 1 }  // صورة واحدة على الشاشات الكبيرة
        }
    });

    // Carousel for feedbacks
    $(".feedback-slider").owlCarousel({
        items: 1, // عرض عنصر واحد في نفس الوقت
        loop: true,
        margin: 20,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        nav: true,
        navText: ["<div class='nav-btn prev-btn'><</div>", "<div class='nav-btn next-btn'>></div>"],
    });
});




</script>

<style>

</style>
@endsection  
