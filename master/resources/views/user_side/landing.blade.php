@extends('layouts.app-user')

@section('content')

{{-- ---------------------------------------------hero section --------------------------------- --}}
<section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url('new.png');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-7 col-sm-12 element-animate">
                    <h1 class="mb-4">Fastest-Growing Construction Company</h1>
                    <p class="mb-0"><a href="{{ route('more_subsalons') }}" target="_blank" class="btn btn-primary">Get Started</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="slider-item" style="background-image: url('new.png');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-8 col-sm-12 element-animate">
                    <h1 class="mb-4">We Are Leading The Way Construction Works</h1>
                    <p class="mb-0"><a href="{{ route('more_subsalons') }}" target="_blank" class="btn btn-primary">Get Started</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ---------------------------------------------about section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 pr-lg-5 mb-5 mb-md-0 element-animate">
                <h2 class="text-uppercase heading border-bottom mb-4 text-left">About us <br>Salonak Website</h2>
                <p>Salonak is a website that allows you to book appointments at various salons regardless of their geographical location. Enjoy competitive and affordable prices at times that suit you, with the opportunity to receive multiple discounts. You can also view experiences and reviews from others before making your booking.</p>
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
                <h2 class="text-uppercase heading border-bottom mb-4">Recent Projects</h2>
                <p class="mb-3 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
                <p><a href="works.html" class="btn btn-primary">See All Projects</a></p>
            </div>
        </div>

        <div class="row no-gutters">
            @foreach ($allSubsalons->slice(0,3) as $subsalon)
                <div class="col-md-4 element-animate">
                    <a href="works-single.html" class="link-thumbnail">
                        <h3>{{ $subsalon->salon->name }}</h3>
                        <span class="icon">
                            <button class="btn btn-primary">See More</button>
                        </span>
                        <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid" style="width: 450px; height: 400px;">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ---------------------------------------------Our News section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5 element-animate">
            <div class="col-md-8 text-center mb-5">
                <h2 class="text-uppercase heading border-bottom mb-4">Our News</h2>
                <p class="mb-0 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
            </div>
        </div>
        <div class="row element-animate">
            <div class="major-caousel js-carousel-1 owl-carousel">
                @foreach ($allSubsalons->slice(0,6) as $subsalon)
                    <div>
                        <div class="media d-block media-custom text-left">
                            <img src="{{ $subsalon->salon->image }}" alt="Image Placeholder" class="img-fluid" style="width: 400px; height: 400px; object-fit: cover;">
                            <div class="media-body">
                                <span class="meta-post">December 2, 2017</span>
                                <h3 class="mt-0 text-black"><a href="#" class="text-black">{{ $subsalon->salon->name }}</a></h3>
                                <p>{{ Str::limit($subsalon->description, 100) }}</p>
                                <p class="clearfix">
                                    <a href="{{ route('single_salon', $subsalon) }}" class="btn btn-primary">See More</a>
                                    <a href="#" class="float-right meta-chat"><span class="ion-chatbubble"></span> 8</a>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ---------------------------------------------Contact Us section --------------------------------- --}}
<section class="section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4 text-start">
                <h3 class="line-height-1 mb-3">
                    <span class="d-block display-4 line-height-1 text-black">Contact us with</span>
                    <span class="d-block display-4 line-height-1"><p class="font-weight-bold">Salonak</p></span>
                </h3>
                <p>We’re here to help! If you have any questions or feedback, please don’t hesitate to reach out. The "Your Salon" team is eager to assist you and answer any inquiries you may have.</p>
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
@if (session('success'))
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        };
    </script>
@endif

@if ($errors->has('email'))
    <script>
        window.onload = function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Check your email.',
                showConfirmButton: false,
                timer: 2000
            });
        };
    </script>
@endif

@endsection
