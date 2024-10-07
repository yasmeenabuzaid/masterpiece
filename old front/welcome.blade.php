<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- <title>Laravel</title> --}}
    @extends('layouts.app-user')
    @section('content')
        <main>
            <img src="../img/home.jpg" alt="صورة خلفية">
            <div class="overlay"></div>
            <div class="content">
                <div class="welcome_text">
                    <h3>WELCOME TO</h3>
                    <h1 class="big-title">Beauty Connect</h1>
                </div>
                <a href="index2.html">
                    <button class="start-btn">
                        explore more
                        <div class="star-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-3">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-5">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                        <div class="star-6">
                            <svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve" version="1.1"
                                style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
                                viewBox="0 0 784.11 815.53" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <defs></defs>
                                <g id="Layer_x0020_1">
                                    <metadata id="CorelCorpID_0Corel-Layer"></metadata>
                                    <path class="fil0"
                                        d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z">
                                    </path>
                                </g>
                            </svg>
                        </div>
                    </button>
                </a>
            </div>
        </main>
        <section>
            <h1>our services</h1>
            <div class="services">
                <div class="service-item">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <h5>Service 1</h5>
                    <p>Short description of Service 1.</p>
                </div>
                <div class="service-item">
                    <i class="fa-solid fa-star"></i>
                    <h5>Service 2</h5>
                    <p>Short description of Service 2.</p>
                </div>
                <div class="service-item">
                    <i class="fa-solid fa-heart"></i>
                    <h5>Service 3</h5>
                    <p>Short description of Service 3.</p>
                </div>
            </div>
        </section>

        {{-- <section>
            <h1>The Best Salons</h1>
            <div class="slider">
                <div class="slider-wrapper">

                    @foreach ($salons->slice(0, 4) as $salon)
                        <div class="slide">
                            <div class="image-container">
                                <img src="{{ asset($salon->image) }}" alt="Salon Image">
                                <div class="overlay"></div>
                                <div class="card-content">


                                </div>
                            </div>
                            {{-- <div class="card-btns">
                                <i class="fa-regular fa-comment-dots"></i> 200 | <i class="fa-regular fa-bookmark"></i> 50 | <i class="fa-regular fa-user"></i> 4
                            </div> --}}
                            {{--
                                <h3>{{ $salon->name }}</h3>
                                <span>{{ $salon->description }}</span> --}}

                        {{-- </div>
                    @endforeach

                </div>

            </div>
            <button class ="see-more-btn">see more</button>
        </section> --}}
        <section>
            <h1>The Best Salons</h1>

            <div class="products-section">
                @foreach ($salons->slice(0, 4) as $salon)
                <div class="product-card">
                    <img src="{{ asset($salon->image) }}" alt="Gentle Exfoliating Scrub">

                    <div class="product-title">{{$salon->name }}</div>
                    <div class="product-price">{{$salon->description }}</div>
                </div>
                @endforeach

                {{-- <div class="product-card">
                    <img src="path/to/eye_cream.jpg" alt="Anti-Aging Eye Cream">
                    <div class="product-title">Anti-Aging Eye Cream</div>
                    <div class="product-price">JD35.000</div>
                </div>
                <div class="product-card">
                    <img src="path/to/facial_serum.jpg" alt="Hydrating Facial Serum">
                    <div class="product-title">Hydrating Facial Serum</div>
                    <div class="product-price">JD30.000</div>
                </div> --}}
            </div>

            {{-- <button class ="see-more-btn">see more</button> --}}
        </section>
        {{-- <section>
    <div class="items">
        <div class="cat-col">
        <div class="item1">1</div>
        <div class="item2">1</div>
    </div>
    <div class="div-2">
        <div class="item3">1</div>
        <div class="row">
        <div class="item4">1</div>
        <div class="item5">1</div>
        <div class="item6">1</div>
    </div>
    </div>
    </div>
    </div>
</section> --}}
        {{-- <section class="comments-section">
    <h2>Post Comments</h2>
    <div class="Comment">
        <div class="p-info">
            <img src="https://i.pinimg.com/736x/c0/74/9b/c0749b7cc401421662ae901ec8f9f660.jpg" alt="Profile Picture">
            <div class="info">
            <h1>Tamer</h1>
            <span>2004/2/4</span>
        </div>

        </div>
        <form class="comment-form" action="{{ route('testimonials.store') }}" method="POST">
            @csrf
            <input type="text" placeholder="Write your testimonial here..." name='testimonial' id='testimonial' required>
            <button type="submit"><i class="fa-solid fa-arrow-right"></i>  Submit Comment</button>
        </form>
    </div>
    <div class="comments-list">
        <div class="comment">
            <p><strong>Commenter Name:</strong> Comment goes here...</p>
        </div>
        <!-- Add more comments here -->
    </div> --}}
        </section>


        <!-- Testimonial start -->
        <section>
            <div class="mx-auto text-center" style="max-width: 700px;">

                <h1> Our Testimonials</h1>

            </div>
            <div class="services">
                <div class="service-item">
                    <div class="ms-4">
                        <div id="user-info-t">
                            <div class="border border-primary bg-white rounded-circle">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    class="rounded-circle p-2"
                                    style="width: 80px; height: 80px; border-color: var(--bs-primary);" alt="Client Image">
                            </div>
                            <div class="flex-col">
                                <div>
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                </div>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                            </div>
                        </div>

                        <br>
                        {{-- <hr> --}}
                        <br>
                        <div class="border-top mt-7 pt-3">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing industry.</p>
                        </div>
                    </div>
                </div>
                <div class="service-item">
                    <div class="ms-4">
                        <div id="user-info-t">
                            <div class="border border-primary bg-white rounded-circle">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    class="rounded-circle p-2"
                                    style="width: 80px; height: 80px; border-color: var(--bs-primary);"
                                    alt="Client Image">
                            </div>
                            <div class="flex-col">
                                <div>
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                </div>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                            </div>
                        </div>

                        <br>
                        {{-- <hr> --}}
                        <br>
                        <div class="border-top mt-7 pt-3">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing industry.</p>
                        </div>
                    </div>
                </div>
                <div class="service-item">
                    <div class="ms-4">
                        <div id="user-info-t">
                            <div class="border border-primary bg-white rounded-circle">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    class="rounded-circle p-2"
                                    style="width: 80px; height: 80px; border-color: var(--bs-primary);"
                                    alt="Client Image">
                            </div>
                            <div class="flex-col">
                                <div>
                                    <h4 class="text-dark">Client Name</h4>
                                    <p class="m-0 pb-3">Profession</p>
                                </div>
                                <div class="d-flex pe-5">
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                    <i class="fas fa-star text-gold"></i>
                                </div>
                            </div>
                        </div>

                        <br>
                        {{-- <hr> --}}
                        <br>
                        <div class="border-top mt-7 pt-3">
                            <p class="mb-0">Lorem Ipsum is simply dummy text of the printing industry.</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- Testimonial end -->

        <h1> about us</h1>
        <div class="contact">
            <div class="contact-container">
                <img src="https://media.istockphoto.com/id/652327300/photo/beautiful-girl-surrounded-by-hands-of-makeup-artists-with-brushes-and-lipstick-near-her-face.jpg?s=612x612&w=0&k=20&c=uPTRzhnN24QqsC5N_Y2WD5SB8u34udY9x7uhGlUfPXA="
                    alt="">

            </div>
            <div class="about-section">
                <h4 class="about-title">About Us</h4>
                <p class="about-description">
                    Welcome to our website! We are dedicated to providing the best services for our customers.
                    Our team is experienced and passionate about what we do. Feel free to reach out for any inquiries!
                </p>
                <div class="about-services">
                    <div class="about-service-column">
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 1</li>
                        </div>
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 2</li>
                        </div>
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 3</li>
                        </div>
                    </div>
                    <div class="about-service-column">
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 4</li>
                        </div>
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 5</li>
                        </div>
                        <div class="about-service-item">
                            <i class="fa-solid fa-star"></i>
                            <li>Service 6</li>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h1>Contact Us</h1>
        <div class="contact">
            <div class="contact-container">
                <form id="contactForm">
                    <div class="input-row">
                        <div class="input-group">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="input-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                    </div>
                    <div>
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>

            </div>
        </div>
        </body>

    </html>
