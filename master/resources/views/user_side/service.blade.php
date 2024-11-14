@extends('layouts.app-user')

@section('content')

<!-- Section for Salon Owner -->
<section class="inner-page">
  <div class="slider-item py-5" style="background-image: url('img/slider-2.jpg');">
    <div class="container">
      <div class="row slider-text align-items-center justify-content-center text-center">
        <div class="col-md-7 col-sm-12 element-animate">
          <h1 class="text-white">Our Services</h1>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section bg-light">
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
</section>

    <div class="container">

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

@endsection
