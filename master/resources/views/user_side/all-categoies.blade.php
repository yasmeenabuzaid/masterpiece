@extends('layouts.app-user')

@section('content')

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

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-blueprint icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">House Renovation</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-building-1 icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">Construction Consultant</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-crane icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">General Contracting</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-helmet icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">Laminate Flooring</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-building icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">Metal Roofing</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12 mb-3 element-animate">
          <div class="media d-block media-feature text-center">
            <span class="flaticon-engineer icon"></span>
            <div class="media-body">
              <h3 class="mt-0 text-black">General Contracting</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-outline-primary btn-sm">Learn More</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- END section -->

  <section class="section border-t">
    <div class="container">
      <div class="row justify-content-center mb-5 element-animate">
        <div class="col-md-8 text-center">
          <h2 class="text-uppercase heading border-bottom mb-4">See Our Recent Works</h2>
          <p class="mb-3 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
          <p><a href="works.html" class="btn btn-primary">View All Works</a></p>
        </div>
      </div>

      <div class="row no-gutters">
        <div class="col-md-4 element-animate">
          <a href="works-single.html" class="link-thumbnail">
            <h3>Wood Polishing</h3>
            <span class="ion-plus icon"></span>
            <img src="img/work_thumb_1.jpg" alt="Image placeholder" class="img-fluid">
          </a>
        </div>
        <div class="col-md-4 element-animate">
          <a href="works-single.html" class="link-thumbnail">
            <h3>General Construction Building</h3>
            <span class="ion-plus icon"></span>
            <img src="img/work_thumb_2.jpg" alt="Image placeholder" class="img-fluid">
          </a>
        </div>
        <div class="col-md-4 element-animate">
          <a href="works-single.html" class="link-thumbnail">
            <h3>House Renovation</h3>
            <span class="ion-plus icon"></span>
            <img src="img/work_thumb_3.jpg" alt="Image placeholder" class="img-fluid">
          </a>
        </div>
      </div>

    </div>
  </section>
  <!-- END section -->


  <section class="section">
    <div class="container">
      <div class="row justify-content-center mb-5 element-animate">
        <div class="col-md-8 text-center mb-5">
          <h2 class="text-uppercase heading border-bottom mb-4">Testimonial</h2>
          <p class="mb-0 lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6 element-animate">
          <div class="media d-block media-testimonial text-center">
            <img src="img/person_1.jpg" alt="Image placeholder" class="img-fluid mb-3">
            <p>Jane Doe, <a href="#">XYZ Inc.</a></p>
            <div class="media-body">
              <blockquote>
                <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.&rdquo;</p>
              </blockquote>

            </div>
          </div>
        </div>

        <div class="col-md-6 element-animate">
          <div class="media d-block media-testimonial text-center">
            <img src="img/person_3.jpg" alt="Image placeholder" class="img-fluid mb-3">
            <p>John Doe, <a href="#">XYZ Inc.</a></p>
            <div class="media-body">
              <blockquote>
                <p>&ldquo;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.&rdquo;</p>
              </blockquote>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section class="container cta-overlap">
    <div class="text d-flex">
      <h2 class="h3">Contact Us For Projects or Need a Quotations</h2>
      <div class="ml-auto btn-wrap">
        <a href="get-quote.html" class="btn-cta btn btn-outline-white">Get A Quote</a>
      </div>
    </div>
  </section>
  <!-- END section -->
  @endsection
