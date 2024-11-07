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
        display: flex;
    }

    .search-input {
        width: 80%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
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

    .custom-slider-salon {
    margin-top: 20px;
}

.custom-slider-salon {
    margin-top: 20px;
}

.custom-slider-salon .item {
    display: flex;
    justify-content: center;
}

.custom-slider-salon img {
    transition: transform 0.6s ease;
    object-fit: cover;
    height: 300px;
    width: 100%;
}


.site-block-feature-7 {
    border-radius: 10px;
    transition: transform 0.3s;
    background-color: #f8f9fa;
    height: 300px;
    margin: 10px;
}

.full-width-img {
    width: 100%;
    height: auto;
    object-fit: cover;
}

.site-block-feature-7 {
    height: 100%;
}

 h2{
    font-size: 60px;
 }
 .search-button {
    padding: 10px 35px;
    font-size: 16px;
    background-color: #484848; /* لون الزر الجديد */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;

}
/* إزالة هوفر من الزر */
.search-button:hover {
    background-color: #484848; /* احتفظ بنفس لون الخلفية عند المرور */
    color: white; /* تأكد من أن اللون يبقى أبيض */
    cursor: pointer; /* الاحتفاظ بالسهم العادي عند المرور */
}

/* إزالة هوفر من الرابط (اللينك) */
a:hover {
    text-decoration: none; /* إزالة التسطير عند مرور الماوس */
    color: inherit; /* الحفاظ على نفس اللون عند المرور */

}
.site-blocks-cover {
        background-attachment: fixed; /* تثبيت الصورة */
        background-size: cover; /* تغطية العنصر بالكامل بالصورة */
        background-position: center; /* تحديد مركز الصورة */
    }

</style>

<div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover inner-page-cover" style="background-image: url('{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container" style="position: relative; height: 90%; padding: 0; margin: 0;">
            <div class="text-container" style="position: absolute; bottom: 20px; left: 0; text-align: left;">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                    <h2 class="text-white font-weight-light mb-2 display-1">{{ $subsalon->salon->name }}.{{ $subsalon->address }}</h2>
                    <div class="search-section">
                        <h4 style="padding-left: 20px">Location: {{$subsalon->location}}</h4>
                        <h4 style="padding-left: 20px">Type of this salon: {{$subsalon->type}}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<br>
<br>


<div class="container">
    <div class="row justify-content-center ">
        <div class="row justify-content-center mb-5 ">
            <div class="col-md-7 text-center">
                <h2 >more details for this salon</h2>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-7">
            <div class="owl-carousel  custom-slider-salon">
                @foreach($subsalon->images as $image)
                    <div class="item mb-3">
                        <div >
                            <img src="{{ asset($image->image) }}" alt="Salon Image" class="img-fluid full-width-img" style="width: 700px">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4 align-self-center">
            <h1 >Welcome to {{ $subsalon->name }} Salon</h1>
            <p class="paragraph-description mb-4">{{ $subsalon->description }}</p>
            <div class="row gy-2 gx-4 mb-4">
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-star"></i> Expert Stylists</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Easy Online Booking</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Transparent Pricing</p></div>
                <div class="col-sm-6"><p class="mb-0"><i class="bi bi-check"></i> Customer Reviews</p></div>
            </div>
            <a href="{{ route('all-categories', $subsalon) }}" class="search-button">Book Now</a>
        </div>
    </div>

    <br>
    <br>

<div class="site-section bg-light ">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <h2 >Feedbacks</h2>
            </div>
        </div>

        <div class="owl-carousel owl-theme feedback-slider">
            @foreach($feeds as $feed)
                <div class="item text-center mb-5">
                    <div class="feedback-box" style="border: 1px solid #b8b8b8; padding: 10px; border-radius: 10px; background-color: #ffffffda;">
                        <div class="d-flex align-items-center mb-4">
                            <div class="image-container" style="margin-right: 10px; text-align: center;">
                                <img src="{{ $feed->user->image ?? 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjhNf9omxKz2fKDDGINL73mREg3C9H29w8NObPfh7Is55R63Tjp7GFsZvOeq-qXYDltDg&usqp=CAU' }}" alt="User Image" class="img-fluid rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <div>
                                <h4 class="text-black font-weight-bold mb-1">{{ $feed->user->name }}</h4>
                                <p class="text-muted mb-1">{{ $feed->created_at->format('Y-m-d') }}</p>
                            </div>
                        </div>

                        <div class="rating mb-3">
                            <span class="fs-18 cl11">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= $feed->rating ? 'bi-star-fill' : 'bi-star' }}" style="color: #f9ba48;"></i>
                                @endfor
                            </span>
                        </div>

                        <h5 class="text-black font-weight-light mb-3">{{ $feed->feedback }}</h5>
                    </div>
                </div>
            @endforeach
        </div>



@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif
<br>
<br>
<br>
<br>
        @if(Auth::check())
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center">
                    <h2 >Add Your Feedback</h2>
                    <form action="{{ route('feeds.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="feedback" class="form-control custom-textarea" rows="3" placeholder="Write your feedback here" required></textarea>
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
                                    const stars = document.querySelectorAll('.item-rating');
                                    stars.forEach((star, index) => {
                                        if (index < rating) {
                                            star.classList.add('bi-star-fill');
                                            star.classList.remove('bi-star');
                                        } else {
                                            star.classList.add('bi-star');
                                            star.classList.remove('bi-star-fill');
                                        }
                                    });
                                }
                            </script>
                        </div>

                        <input type="hidden" name="users_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="sub_salons_id" value="{{ $subsalon->id }}">
                        <button type="submit" class="search-button">Submit Feedback</button>
                    </form>

                </div>
            </div>
        @else
        <div class="text-center">
            <h4 style="margin-bottom: 40px;">Please log in to add your feedback!</h4>
            <a href="{{ route('login') }}" class="search-button">Log In</a>
        </div>

        @endif
    </div>
</div>
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

    .feedback-slider .item {
    padding: 10px;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}

.feedback-box {
    max-width: 550px;
    width: 100%;
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.feedback-box .image-container img {
    width: 40px;
    height: 40px;
    object-fit: cover;
}

.feedback-box h4 {
    margin-bottom: 5px;
    font-size: 16px;
}

.feedback-box h5 {
    font-size: 14px;
    color: #333;
}

.feedback-box .rating {
    margin-bottom: 10px;
}
.custom-textarea {
    background-color: #ffffff;
    border: 1px solid #ccc;
    color: #333;
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
<script>
    // التحقق من تعبئة الحقول قبل إرسال النموذج
    function validateForm(event) {
        // تحقق من وجود نص في الحقل المخصص للفيدباك
        const feedback = document.getElementsByName('feedback')[0].value.trim();
        const rating = document.getElementById('rating').value;

        // إذا لم يكن هناك فيدباك أو تقييم
        if (!feedback) {
            alert('Please write your feedback.');
            event.preventDefault();
            return false;
        }

        if (!rating) {
            alert('Please select a rating.');
            event.preventDefault();
            return false;
        }

        return true;
    }

    // إضافة حدث التحقق على النموذج عند الإرسال
    document.querySelector('form').addEventListener('submit', validateForm);
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
        nav: false, // إزالة الأسهم
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
        nav: false, // إزالة الأسهم
    });
});




</script>

<style>

</style>
@endsection
