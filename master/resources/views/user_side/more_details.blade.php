@extends('layouts.app-user')

@section('content')
<section class="section py-5">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 p-0">
                <img src="{{ asset($subsalon->image ?? 'default_image.jpg') }}" alt="Image placeholder" class="img-fluid rounded shadow-lg" style="width: 600px; height: 500px;">
            </div>

            <div class="col-md-6 p-0">
                <h2 class="text-uppercase font-weight-bold mb-4 ">
                    About Us - {{ $subsalon->salon->name }}
                </h2>
                <p class="text-muted mb-4">{{ $subsalon->salon->description }}</p>
                <p class="mb-4">{{ $subsalon->description }}</p>

                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-map-marker-alt text-primary"></i> <strong>Location:</strong> {{ $subsalon->location }}</li>
                            <li><i class="fas fa-map-signs text-primary"></i> <strong>Address:</strong> {{ $subsalon->address }}</li>
                            <li><i class="fas fa-cogs text-primary"></i> <strong>Salon Type:</strong> {{ $subsalon->type }}</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li><i class="fas fa-calendar-week text-primary"></i> <strong>Working Days:</strong> {{ implode(', ', $subsalon->working_days) }}</li>
                            <li><i class="fas fa-clock text-primary"></i> <strong>Working Hours:</strong>
                                {{ \Carbon\Carbon::parse($subsalon->opening_hours_start)->format('H:i') }} -
                                {{ \Carbon\Carbon::parse($subsalon->opening_hours_end)->format('H:i') }}
                            </li>
                                                    </ul>
                    </div>
                </div>



                <a href="{{ route('subsalons.categories-services', $subsalon) }}" class="btn btn-primary btn-lg mt-4">
                    Book Now
                </a>
            </div>
        </div>
    </div>
</section>


    <!-- More Images Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center element-animate">
                <div class="col-md-8 text-center">
                    <h2 class="text-uppercase heading border-bottom font-weight-bold  mb-4">More images for {{ $subsalon->salon->name }}</h2>
                </div>
            </div>

            <div class="row element-animate">
                <div class="major-caousel js-carousel-1 owl-carousel">
                    @foreach ($subsalon->images as $image)
                        <div>
                            <a class="link-thumbnail">
                                <img src="{{ asset($image->image) }}" alt="Salon Image" class="img-fluid" style="width: 100%; height: 400px; object-fit: cover;">

                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="row justify-content-center mb-5 element-animate">
                <div class="col-md-8 text-center">
                    <h2 class="text-uppercase heading border-bottom font-weight-bold mb-4">Categories</h2>

                </div>
            </div>

            <div class="row mb-5">
                <!-- Loop over categories and display each in a 4-column grid -->
                @foreach ($subsalon->categories->slice(0,4) as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12 element-animate">
                        <div class="media d-block media-feature text-center">
                            <div class="media-body">
                                <h6 class="text-uppercase heading border-bottom mb-4">{{ $category->name }}</h6>
                                <p>{{ $category->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- END row -->

            <div class="row justify-content-center element-animate">
                <div class="col-md-4">
                    <a href="{{ route('subsalons.categories-services', $subsalon) }}" class="btn btn-primary btn-block">
                        View All Categories
                    </a>
                </div>
            </div>
        </div>

    </section>
    <!-- END section -->
<style>
.media-body {
    word-wrap: break-word;
    overflow: hidden;
    padding: 5px;
    max-height: 150px;
}

.media-body p {
    font-size: 1rem;
    line-height: 1.5;
}
.modal-backdrop {
    z-index: 1050 !important;
}

.modal {
    z-index: 1051 !important;
}
.sectio {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}

.container {
    padding-left: 15px;
    padding-right: 15px;
}


</style>
    <!-- Feedbacks Section -->
    <section class="sectio border-t">
        <div class="container">
            <div class="row justify-content-center element-animate">
                <div class="col-md-8 text-center mb-5">
                    <h2 class="text-uppercase heading border-bottom mb-4">Feedbacks</h2>

                </div>
            </div>

            <div class="row">
                <div class="major-caousel js-carousel-1 owl-carousel">
                    @foreach ($feeds as $feed)
                        <div class="col-md-12">
                            <div class="card mb-4 p-4 shadow-sm border-light"style="height: 300px;">
                                <div class="media d-flex align-items-center" >
                                    <!-- User Image -->
                                    <img src="{{ $feed->user->image ? asset($feed->user->image) : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjhNf9omxKz2fKDDGINL73mREg3C9H29w8NObPfh7Is55R63Tjp7GFsZvOeq-qXYDltDg&usqp=CAU' }}"
                                        alt="User Image" class="img-fluid rounded-circle"
                                        style="width: 60px; height: 60px; object-fit: cover;">
                                    <div class="ms-3">
                                        <h5 class="mb-0">{{ $feed->user->name }}</h5>
                                        <p class="text-muted mb-0">{{ $feed->created_at->format('F j, Y') }}</p>
                                        <!-- Formatted date -->
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="rating mb-3 mt-2">
                                    <span class="fs-18 cl11">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $feed->rating ? 'bi-star-fill' : 'bi-star' }}"
                                                style="color: #f9ba48;"></i>
                                        @endfor
                                    </span>
                                </div>

                                <!-- Feedback Blockquote -->
                                <div class="media-body mt-3">
                                    <blockquote class="blockquote text-center">
                                        <p>&ldquo;{{ $feed->feedback }}&rdquo;</p>
                                    </blockquote>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@if (Auth::check())
<br>
    <div class="row justify-content-center mb-5">
        <div class="col-md-7 text-center">
            <button id="add-feedback-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#feedbackModal">Add Your Feedback</button>
        </div>
    </div>
@else
    <div class="text-center">
        <h4 style="margin-bottom: 40px;">Please log in to add your feedback!</h4>
        <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
    </div>
    <br>
@endif

<!-- Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Add Your Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('feeds.store') }}" method="POST" onsubmit="return validateForm(event)">
                    @csrf
                    <!-- Feedback Textarea -->
                    <div class="form-group mb-3">
                        <textarea name="feedback" class="form-control form-control-lg" rows="4" placeholder="Write your feedback here" required></textarea>
                    </div>

                    <!-- Rating Section -->
                    <div class="form-group mb-3">
                        <div class="d-flex justify-content-start align-items-center">
                            <span class="me-3" style="font-size: 18px;">Your Rating *</span>
                            <div class="wrap-rating fs-18 cl11 pointer">
                                <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(1)"></i>
                                <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(2)"></i>
                                <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(3)"></i>
                                <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(4)"></i>
                                <i class="item-rating pointer bi bi-star" style="color: #f9ba48;" onclick="setRating(5)"></i>
                            </div>
                        </div>
                        <input class="d-none" type="hidden" name="rating" id="rating" value="" required>
                        <span id="rating-error" class="text-danger" style="display: none;">Please select a rating.</span>
                    </div>

                    <!-- Hidden User ID and Sub Salon ID -->
                    <input type="hidden" name="users_id" value="{{ Auth::id() }}">
                    <input type="hidden" name="sub_salons_id" value="{{ $subsalon->id }}">

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Rating Selection -->
<script>
    // Function to set rating value
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
        document.getElementById('rating-error').style.display = 'none'; // Hide error message if rating is selected
    }

    // Form validation to ensure feedback and rating are filled
    function validateForm(event) {
        const feedback = document.getElementsByName('feedback')[0].value.trim();
        const rating = document.getElementById('rating').value;

        if (!feedback) {
            alert('Please write your feedback.');
            event.preventDefault();
            return false;
        }

        if (!rating) {
            document.getElementById('rating-error').style.display = 'block';
            event.preventDefault();
            return false;
        }

        return true;
    }
</script>

<!-- Include Bootstrap 5 JS Bundle (if not included already) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


    </script>

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
@endsection
