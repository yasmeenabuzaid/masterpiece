@extends('layouts.app-user')

@section('content')
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 order-lg-1 mb-5">
                    <img src="{{ asset($subsalon->salon->image ?? 'default_image.jpg') }}" alt="Image placeholder"
                        class="img-fluid" style="width: 100%; height: auto;">
                </div>
                <div class="col-md-5 order-lg-3">
                    <h2 class="text-uppercase heading border-bottom mb-4 text-left">About us
                        <br>{{ $subsalon->salon->name }}.{{ $subsalon->address }}</h2>
                    <p>{{ $subsalon->description }}</p>

                    <h4 class="text-uppercase mb-3">Categories</h4>


                    <p class="mb-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit,
                        necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>

                    <ul class="list-unstyled check">
                        <li>Soluta sit quam minima</li>
                        <li>Consectetur adipisicing elit</li>
                        <li>Commodi unde impedit</li>
                    </ul>
                    <a href="{{ route('all-categories', $subsalon) }}" class="btn btn-primary">Book Now</a>
                </div>

            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- More Images Section -->
    <section class="section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5 element-animate">
                <div class="col-md-8 text-center">
                    <h2 class="text-uppercase heading border-bottom mb-4">More images for {{ $subsalon->salon->name }}</h2>
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
                    <h2 class="text-uppercase heading border-bottom mb-4">Services</h2>
                    <p class="mb-3 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit,
                        necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
                </div>
            </div>

            <div class="row mb-5">
                @foreach ($subsalon->categories as $category)
                    <div class="col-lg-4 col-md-6 col-12element-animate">
                        <div class="media d-block media-feature text-center">
                            <span class="flaticon-blueprint icon"></span>
                            <div class="media-body">
                                <h6 class="text-uppercase heading border-bottom text-left">{{ $category->name }}</h6>
                                <p>{{ $subsalon->description }}</p>  <!-- عرض الوصف داخل الكارت -->
                                {{-- <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p> --}}
                                <p><a class="btn btn-outline-primary btn-sm">Learn More</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- END row -->
            <div class="row justify-content-center element-animate">
                <div class="col-md-4">
                    <a href="{{ route('showCategoriesBySalon', ['salonId' => $subsalon->salon->id, 'subSalonId' => $subsalon->id]) }}" class="btn btn-primary btn-block">
                        View All Categories
                    </a>

             </div>
            </div>
        </div>
    </section>
    <!-- END section -->
<style>
.media-body {
    word-wrap: break-word;  /* لضمان التفاف النص داخل الكارت */
    overflow: hidden;       /* منع النص من التجاوز */
    padding: 5px;
    max-height: 150px;      /* تحديد الحد الأقصى لارتفاع النص */
}

.media-body p {
    font-size: 1rem;
    line-height: 1.5;
}

</style>
    <!-- Feedbacks Section -->
    <section class="section border-t">
        <div class="container">
            <div class="row justify-content-center element-animate">
                <div class="col-md-8 text-center mb-5">
                    <h2 class="text-uppercase heading border-bottom mb-4">Feedbacks</h2>
                    <p class="mb-0 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit,
                        necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
                </div>
            </div>

            <div class="row">
                <div class="major-caousel js-carousel-1 owl-carousel">
                    @foreach ($feeds as $feed)
                        <div class="col-md-12">
                            <div class="card mb-4 p-4 shadow-sm border-light">
                                <div class="media d-flex align-items-center">
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

    <!-- Button to show feedback form in Modal -->
    @if (Auth::check())
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center">
                <button id="add-feedback-btn" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#feedbackModal">Add Your Feedback</button>
            </div>
        </div>
    @else
        <div class="text-center">
            <h4 style="margin-bottom: 40px;">Please log in to add your feedback!</h4>
            <a href="{{ route('login') }}" class="btn btn-primary">Log In</a>
        </div>
    @endif

    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="feedbackModalLabel">Add Your Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('feeds.store') }}" method="POST" onsubmit="return validateForm(event)">
                        @csrf
                        <div class="form-group">
                            <textarea name="feedback" class="form-control form-control-lg" rows="3" placeholder="Write your feedback here"
                                required></textarea>
                        </div>

                        <div class="form-group">
                            <div class="flex-w flex-m p-t-50 p-b-23">
                                <span class="stext-102 cl3 m-r-16">Your Rating *</span>
                                <span class="wrap-rating fs-18 cl11 pointer">
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;"
                                        onclick="setRating(1)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;"
                                        onclick="setRating(2)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;"
                                        onclick="setRating(3)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;"
                                        onclick="setRating(4)"></i>
                                    <i class="item-rating pointer bi bi-star" style="color: #f9ba48;"
                                        onclick="setRating(5)"></i>
                                    <input class="dis-none" type="hidden" name="rating" id="rating" value=""
                                        required>
                                </span>
                            </div>
                            <!-- Message for missing rating -->
                            <span id="rating-error" class="text-danger" style="display: none;">Please select a
                                rating.</span>
                        </div>

                        <input type="hidden" name="users_id" value="{{ Auth::id() }}">
                        <input type="hidden" name="sub_salons_id" value="{{ $subsalon->id }}">
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
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
            document.getElementById('rating-error').style.display = 'none';
        }

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
