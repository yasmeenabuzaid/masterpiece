@extends('layouts.app-user')

@section('content')
<section class="inner-page">
    <div class="slider-item py-5" style="background-image: url('https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600');">
      <div class="container">
        <div class="row slider-text align-items-center justify-content-center text-center">
          <div class="col-md-7 col-sm-12 element-animate">
            <h1 class="text-white">About Us</h1>
          </div>
        </div>
      </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 order-lg-3">
                {{-- <img src="https://i.pinimg.com/736x/d7/22/c7/d722c758486ce8805b4da20358c87684.jpg" alt="Image placeholder" class="img-fluid"> --}}
            </div>
            <div class="col-md-1 order-lg-2"></div>
            <div class="col-md-5 order-lg-1">
                <h2 class="text-uppercase heading mb-4">about salonak</h2>
                <p>In today's busy world, finding a salon that offers great service at the right time and at an affordable price can be a challenge. That's why we created "Salonek" – an innovative online platform that brings together the best salons in Jordan, allowing you to book your appointments quickly and easily, at your convenience.</p>

                <p>"Salonek" is not just a directory of salons, but a unique experience. You can choose the service you need, select your preferred staff member, and book your appointment with just a few clicks. We're here to ensure your experience with "Salonek" is as smooth and convenient as possible.</p>
            </div>

            <div class="col-md-6 mb-5">
                <img src="https://media.istockphoto.com/id/2173348693/photo/barbershop-tools-set-scissors-shaving-machine-comb-and-trimmer-lie-on-a-gray-background.jpg?s=612x612&w=0&k=20&c=Syzj8EPLZ3JRMvQOr8e7sFR1VkzP0w3rtjiZELBHR_Y=" class="img-fluid mb-4" style="max-width: 100%; height: auto;">

            </div>
        </div>
    </section>
        {{-- <section class="section bg-light">
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
                                        <li><i class="fas fa-check-circle"></i> Limited booking options</li>
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
                                        <li><i class="fas fa-check-circle"></i> Unlimited bookings</li>
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
            </style> --}}
<section class="inner-page">
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
        let startValue = 0; // start value
        const duration = 2000; // time -> 2 seconds -> 200 milliseconds
        const increment = endValue / (duration / 50); // Calculate increment per 50ms
        const counterElement = document.getElementById(id);

        const interval = setInterval(() => { //start animateCounter
            startValue += increment;
            if (startValue >= endValue) {
                startValue = endValue;
                clearInterval(interval); //endvalue
            }
            counterElement.textContent = Math.round(startValue);
        }, 50); // update number in brower
    }

    // Start counting
    animateCounter('salons-count', {{ $salonCount }});
    animateCounter('subsalons-count', {{ $subsalonCount }});
    animateCounter('appointments-count', {{ $bookingCount }});
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




<section class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 mb-5">
                <img src="https://images.pexels.com/photos/7697393/pexels-photo-7697393.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" alt="Image placeholder" class="img-fluid mb-4" style="width:600px;hight:600px">
                <p>Through "Salonek," you can read reviews and feedback from other clients, helping you make the right decision before booking your appointment. We believe that transparency and convenience are key to a great customer experience.</p>


                <p class="mb-3">"Salonek" was born out of a simple idea to make beauty and wellness services more accessible and convenient for everyone. We wanted to create a platform that brings all the best salons together in one place, allowing customers to book their services easily and confidently.</p>

            </div>

            <div class="col-md-6 mb-5">
                <img src="https://images.pexels.com/photos/13714797/pexels-photo-13714797.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" class="img-fluid mb-4" style="max-width: 100%; height: auto;">

                <ul class="list-unstyled check">
                    <ul class="list-unstyled check">
                        <li>Easily choose from a wide range of services</li>
                        <li>Book an appointment that fits your schedule and the salon's availability</li>
                        <li>Benefit from transparency with genuine client reviews</li>
                    </ul>
                    <li>A user-friendly interface to find salons near you</li>
                    <li>Quick and secure booking process</li>
                    <li>Comprehensive reviews and ratings for informed decisions</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Section for Salon Owner -->
{{-- <section class="inner-page">
  <div class="slider-item py-5" style="background-image: url('https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center text-center">
        <div class="col-md-7 col-sm-12 element-animate">
          <h1 class="text-white">Our Services</h1>
        </div>
      </div>
    </div>
  </div>
</section> --}}

{{-- <section class="section bg-light">
  <div class="container">
    <div class="row">
        <div class="row justify-content-center mb-5 element-animate">
            <div class="col-md-8 text-center">
              <h2 class="text-uppercase heading border-bottom mb-4">Our Services for Salon Owners</h2>
            </div>
          </div>
      <!-- Service 1 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-cogs icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Salon Management</h3>
            <p>Manage your salon operations seamlessly with easy-to-use tools.</p>
          </div>
        </div>
      </div>

      <!-- Service 2 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-calendar-check icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Appointment Scheduling</h3>
            <p>Allow clients to book appointments online with ease.</p>
          </div>
        </div>
      </div>

      <!-- Service 3 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-tag icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Price Management</h3>
            <p>Set prices for your services and update them easily.</p>
          </div>
        </div>
      </div>

      <!-- Service 4 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-users icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Client Profiles</h3>
            <p>Store detailed information about your clients for personalized services.</p>
          </div>
        </div>
      </div>

      <!-- Service 5 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-cogs icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Salon Customization</h3>
            <p>Customize your salon layout and environment with our management tools.</p>
          </div>
        </div>
      </div>

      <!-- Service 6 -->
      <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
        <div class="media d-block media-feature text-center">
          <span class="fas fa-share-alt icon mb-5"></span> <!-- FontAwesome Icon -->
          <div class="media-body">
            <h3 class="mt-0 text-black">Social Media Integration</h3>
            <p>Connect with your clients via social media for promotions and updates.</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section> --}}

    {{-- <div class="container">

        <section class="section bg-light">
            <div class="container">
                <div class="row">
                    <div class="row justify-content-center mb-5 element-animate">
                      <div class="col-md-8 text-center">
                        <h2 class="text-uppercase heading border-bottom mb-4">Our Services for Customers</h2>
                      </div>
                    </div>

                    <!-- Service 1 -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
                        <div class="media d-block media-feature text-center">
                          <span class="fas fa-calendar-alt icon mb-5"></span> <!-- FontAwesome Icon -->
                          <div class="media-body">
                            <h3 class="mt-0 text-black">Easy Booking</h3>
                            <p>Book your appointments effortlessly through our online system.</p>
                          </div>
                        </div>
                    </div>

                    <!-- Service 2 -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
                        <div class="media d-block media-feature text-center">
                          <span class="fas fa-camera-retro icon mb-5"></span> <!-- FontAwesome Icon -->
                          <div class="media-body">
                            <h3 class="mt-0 text-black">View Salon Portfolio</h3>
                            <p>Browse through our gallery to see our best work and services.</p>
                          </div>
                        </div>
                    </div>

                    <!-- Service 3 -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
                        <div class="media d-block media-feature text-center">
                          <span class="fas fa-clock icon mb-5"></span> <!-- FontAwesome Icon -->
                          <div class="media-body">
                            <h3 class="mt-0 text-black">Appointment Details</h3>
                            <p>Check the details of your appointments anytime, from anywhere.</p>
                          </div>
                        </div>
                    </div>

                    <!-- Service 4 -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
                        <div class="media d-block media-feature text-center">
                          <span class="fas fa-tag icon mb-5"></span> <!-- FontAwesome Icon -->
                          <div class="media-body">
                            <h3 class="mt-0 text-black">Prices & Packages</h3>
                            <p>View the latest prices and available packages for all services.</p>
                          </div>
                        </div>
                    </div>

                    <!-- Service 5 -->
                    <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
                        <div class="media d-block media-feature text-center">
                          <span class="fas fa-calendar-check icon mb-5"></span> <!-- FontAwesome Icon -->
                          <div class="media-body">
                            <h3 class="mt-0 text-black">Choose Convenient Time</h3>
                            <p>Select a time slot that fits your schedule when booking an appointment.</p>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>


    </div> --}}
</section>

@endsection
