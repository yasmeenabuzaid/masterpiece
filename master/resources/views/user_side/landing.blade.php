@extends('layouts.app-user')

@section('content')
{{-- ---------------------------------------------hero section --------------------------------- --}}
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-7 col-sm-12 element-animate">
                    <h1 class="display-4 font-weight-bold mb-4">Salonak</h1>
                    <h2 class="mb-4">Beauty services at your fingertips with just one click</h2>
                    <p class="mb-0"><a href="{{ route('more_subsalons') }}"  class="btn btn-primary btn-lg">Find Your Perfect Salon</a></p>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="slider-item" style="background-image: url('https://images.pexels.com/photos/7603842/pexels-photo-7603842.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-8 col-sm-12 element-animate">
                    <h2 class="display-5 mb-4">All the salons in your area are in one place. Your appointment is closer than ever.</h2>
                    <p class="mb-0"><a href="{{ route('more_subsalons') }}"  class="btn btn-primary btn-lg">Get Started</a></p>
                </div>
            </div>
        </div>
    </div> --}}
</section>

<style>
.home-slider .slider-item {
    position: relative;
}

.home-slider .slider-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(44, 44, 44, 0.721);
    z-index: 1;
}

.home-slider .slider-item .container {
    position: relative;
    z-index: 2;
}
</style>

{{-- ---------------------------------------------about section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 element-animate">
                <h2 class="text-uppercase heading border-bottom mb-4 text-left">About Us <br>Salonak Website</h2>
                <p>Salonak is your ultimate destination for beauty and salon services. Our platform brings together a wide range of salons in your area, making it easy to find and book the perfect appointment for you. With Salonak, you can:</p>
                <ul>
                    <li>Access a variety of salons and beauty services, all in one place.</li>
                    <li>Book appointments at any time that suits you with just a few clicks.</li>
                    <li>Enjoy competitive and transparent pricing along with special discounts.</li>
                    <li>Read reviews and view experiences shared by other users before booking.</li>
                    <li>Benefit from exclusive offers and promotions tailored to your needs.</li>
                </ul>
                <p>Whether you're looking for a quick beauty fix or planning for a special event, Salonak ensures a seamless, professional, and convenient experience. Let us help you look and feel your best—whenever and wherever you are.</p>
            </div>
            <div class="col-md-6 element-animate">
                <img src="https://i.pinimg.com/564x/74/5e/bd/745ebded96981da5b75d3e7e346add7a.jpg" alt="About Us Image" class="img-fluid">
            </div>
        </div>
    </div>
</section>

{{-- ---------------------------------------------f-salons section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
            <div class="col-md-8 text-center">
                <h2 class="text-uppercase heading border-bottom mb-4">Top-Rated Salons</h2>
                <p class="mb-3 lead">Discover our most popular salons, each with a customer rating of 4 stars or higher. These salons have been highly rated by our users for their exceptional service, professional staff, and outstanding customer satisfaction. Book an appointment today and experience the best in beauty and care.</p>
                <p><a href="{{ route('more_subsalons') }}" class="btn btn-primary">See All Salons</a></p>
            </div>
        </div>

        <div class="row element-animate">
            <div class="major-caousel js-carousel-1 owl-carousel">
                @foreach ($filteredSubsalons as $subsalon)

                    <div>
                        <div class="media d-block media-custom text-left">
                            @if ($subsalon && $subsalon->image)
                            <img src="{{ $subsalon->image }}" alt="Image Placeholder" class="img-fluid" style="width: 400px; height: 400px; object-fit: cover;">
                        @else
                            <img src="default-image-path.jpg" alt="Default Image" class="img-fluid" style="width: 400px; height: 400px; object-fit: cover;">
                        @endif
                                                    <div class="media-body">
                                <div style="display: flex; align-items: center; justify-content:start;">
                                    <a href="#" class="text-black" style="display: flex; align-items: center;">
                                        @if ($subsalon->salon)
                                        <img src="{{ $subsalon->salon->image }}" alt="Salon Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                                    @else
                                        <img src="default-image-path.jpg" alt="Default Salon Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                                    @endif
                                                                        </a>
                                    <br>
                                    <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between;">
                                    <span><strong>{{ $subsalon->salon->name ?? 'No Salon Available' }}</strong></span>
                                    <span>Location: {{ $subsalon->location ?? 'Not Available' }}</span>
                                </div>
                            </div>
                             <br>
                            <span class="meta-post">{{ $subsalon->type}} salon</span>

                                <p>{{ Str::limit($subsalon->description, 100) }}</p>
                                @php
                                $averageRating = $subsalon->averageRating();
                            @endphp

                            <div class="rating mb-4">
                                <span class="fs-18 cl11">
                                    @if ($averageRating)
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= round($averageRating) ? 'bi-star-fill' : 'bi-star' }}" style="color: #f9ba48;"></i>
                                        @endfor
                                    @else
                                        <p>No ratings yet</p>
                                    @endif
                                </span>
                            </div>
                                <p class="clearfix">
                                    <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
</section>

{{-- --------------------------------------------- start count --------------------------------- --}}
<section class="inner-page" id="stats-section">
    <div class="slider-item py-5" style="background-image: url('https://images.pexels.com/photos/7440052/pexels-photo-7440052.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-7 col-sm-12 element-animate">
                    <h1 class="text-white">Our Stats</h1>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <div class="counter">
                                <h2 class="text-white">Salons</h2>
                                <p id="salons-count" class="display-4 text-white">0</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="counter">
                                <h2 class="text-white">Sub Salons</h2>
                                <p id="subsalons-count" class="display-4 text-white">0</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="counter">
                                <h2 class="text-white">Bookings</h2>
                                <p id="appointments-count" class="display-4 text-white">0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function animateCounter(id, endValue) {
        let startValue = 0;
        const duration = 2000; // 2 seconds
        const increment = endValue / (duration / 50); // Calculate increment
        const counterElement = document.getElementById(id);

        const interval = setInterval(() => {
            startValue += increment;
            if (startValue >= endValue) {
                startValue = endValue;
                clearInterval(interval);
            }
            counterElement.textContent = Math.round(startValue);
        }, 50);
    }

    const statsSection = document.getElementById('stats-section');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter('salons-count', {{ $salonCount }});
                animateCounter('subsalons-count', {{ $subsalonCount }});
                animateCounter('appointments-count', {{ $bookingCount }});
            }
        });
    }, {
        threshold: 0.5
    });

    observer.observe(statsSection);
</script>

<style>
    .slider-item {
        position: relative;
    }

    .slider-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(87, 87, 87, 0.635);
        z-index: 1;
    }

    .slider-item .container {
        position: relative;
        z-index: 2;
    }
</style>


{{-- --------------------------------------------- end count --------------------------------- --}}
{{-- --------------------------------------------- start Featured Salons--------------------------------- --}}

<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
            <div class="col-md-8 text-center mb-5">
                <h2 class="text-uppercase heading border-bottom mb-4">Featured Salons</h2>
                <p class="mb-0 lead">Explore a selection of popular salons offering a variety of beauty services near you. Whether you’re looking for a quick touch-up or a full beauty treatment, find the right salon that fits your needs.</p>
            </div>
        </div>

        <div class="row element-animate">
            <div class="major-caousel js-carousel-1 owl-carousel">
                @foreach ($allSubsalons->slice(0,6) as $subsalon)
                    <div>
                        <div class="media d-block media-custom text-left">
                            @if ($subsalon && $subsalon->image)
                            <img src="{{ $subsalon->image }}" alt="Image Placeholder" class="img-fluid" style="width: 400px; height: 400px; object-fit: cover;">
                        @else
                            <img src="default-image-path.jpg" alt="Default Image" class="img-fluid" style="width: 400px; height: 400px; object-fit: cover;">
                        @endif
                                                    <div class="media-body">
                                <div style="display: flex; align-items: center; justify-content:start;">
                                    <a href="#" class="text-black" style="display: flex; align-items: center;">
                                        @if ($subsalon->salon)
                                        <img src="{{ $subsalon->salon->image }}" alt="Salon Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                                    @else
                                        <img src="default-image-path.jpg" alt="Default Salon Logo" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                                    @endif
                                                                        </a>
                                    <br>
                                    <div style="display: flex; flex-direction: column; align-items: flex-start; justify-content: space-between;">
                                    <span><strong>{{ $subsalon->salon->name ?? 'No Salon Available' }}</strong></span>
                                    <span>Location: {{ $subsalon->location ?? 'Not Available' }}</span>
                                </div>
                            </div>
                             <br>
                            <span class="meta-post">{{ $subsalon->type}} salon</span>

                                <p>{{ Str::limit($subsalon->description, 100) }}</p>

                                <p class="clearfix">
                                    <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                                    {{-- <a href="#" class="float-right meta-chat"><span class="ion-chatbubble"></span> 8</a> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
</section>
{{-- --------------------------------------------- end Featured Salons--------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center  element-animate">
            <div class="col-md-8 text-center">
                <h2 class="text-uppercase heading border-bottom mb-4">Get A Quote</h2>
            </div>
        </div>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Basic Plan</h3>
                        <p class="price">$29.99/month</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle"></i> Basic salon listing</li>
                            <li><i class="fas fa-check-circle"></i> Basic support</li>
                        </ul>
                        <a href="{{route('subscribe')}}" class="btn btn-outline-primary">Subscribe</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-primary">
                    <div class="card-body">
                        <h3 class="card-title">Standard Plan</h3>
                        <p class="price">$49.99/month</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle"></i> Priority salon listing</li>
                            <li><i class="fas fa-check-circle"></i> Advanced support</li>
                            <li><i class="fas fa-check-circle"></i> Performance analytics</li>
                        </ul>
                        <a href="{{route('subscribe')}}" class="btn btn-outline-primary">Subscribe</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">Premium Plan</h3>
                        <p class="price">$79.99/month</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle"></i> Featured salon listing</li>
                            <li><i class="fas fa-check-circle"></i> Full access to all features</li>
                            <li><i class="fas fa-check-circle"></i> Personalized marketing</li>
                            <li><i class="fas fa-check-circle"></i> Priority customer support</li>
                        </ul>
                        <a href="{{route('subscribe')}}" class="btn btn-outline-primary">Subscribe</a>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>

</section>
<!-- Custom CSS for Pricing Cards -->
<style>
    .card {
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 30px;
        text-align: center;
    }

    .card-title {
        font-size: 22px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .price {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #007bff;
    }

    .card .list-unstyled {
        margin-bottom: 20px;
    }

    .card .list-unstyled li {
        margin-bottom: 12px;
        font-size: 16px;
    }

    .card .btn {
        margin-top: 20px;
        padding: 10px 25px;
        font-size: 16px;
    }

    .shadow-lg {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .border-primary {
        border: 2px solid #007bff;
    }

    .btn-outline-primary {
        border: 2px solid #007bff;
        color: #007bff;
        background-color: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }
</style>

{{-- ---------------------------------------------Contact Us section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 text-start">
                <h3 class="line-height-1 mb-3">
                    <span class="d-block display-4 line-height-1 text-black">Contact us with</span>
                    <span class="d-block display-4 line-height-1"><p class="font-weight-bold">Salonak</p></span>
                </h3>
                <p>We’re here to support you! Whether you're a customer with questions or a salon owner interested in partnering with us, we’re excited to hear from you. The Salonak team is dedicated to helping you with any inquiries and exploring new opportunities to bring your business to a wider audience. Reach out today and let's grow together!</p>
            </div>
            <div class="col-md-6 col-lg-4">
                <figure class="h-100 hover-bg-enlarge">
                    <div class="bg-image h-100 bg-image-md-height" style="background-image: url('about.png');"></div>
                </figure>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="border p-4">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" style="color:white">Send Message</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ---------------------------------------------Success/Error Alert Section --------------------------------- --}}
@push('scripts')
    <script>
        // SweetAlert success/error logic
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
@endpush

{{-- --------------------------------------------- end  Success/Error Alert Section --------------------------------- --}}

@endsection
