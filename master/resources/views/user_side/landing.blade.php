@extends('layouts.app-user')

@section('content')

<div class="slide-one-item home-slider owl-carousel">
    <div class="site-blocks-cover" style="background-image: url('{{ asset('salon-landing.png') }}');" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="filter-overlay"></div>
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-8" data-aos="fade-up" data-aos-delay="400">
                    <h2  >Welcome to salonak</h2>
                    <h1 class="text-white font-weight-light mb-2">Book your aesthetic experience at the touch of a button!</h1>
                    {{-- <p><a href="{{route('more_subsalons')}}" class="btn btn-black py-3 px-5">Book Now!</a></p> --}}
<button >
    <a href="{{route('more_subsalons')}}" style="color: #333333">Book Now!</a>  <div class="star-1">
        <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
      >
      <defs></defs>
      <g id="Layer_x0020_1">
          <metadata id="CorelCorpID_0Corel-Layer"></metadata>
          <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
          ></path>
      </g>
    </svg>
</div>
  <div class="star-2">
      <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
      >
      <defs></defs>
      <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
        <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
        ></path>
      </g>
    </svg>
  </div>
  <div class="star-3">
      <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs></defs>
      <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
        <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
        ></path>
      </g>
    </svg>
</div>
<div class="star-4">
    <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs></defs>
      <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
        <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
        ></path>
      </g>
    </svg>
  </div>
  <div class="star-5">
      <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
      >
      <defs></defs>
      <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
        <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
        ></path>
      </g>
    </svg>
</div>
<div class="star-6">
    <svg
      xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 0 784.11 815.53"
      style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
      version="1.1"
      xml:space="preserve"
      xmlns="http://www.w3.org/2000/svg"
    >
      <defs></defs>
      <g id="Layer_x0020_1">
        <metadata id="CorelCorpID_0Corel-Layer"></metadata>
        <path
          d="M392.05 0c-20.9,210.08 -184.06,378.41 -392.05,407.78 207.96,29.37 371.12,197.68 392.05,407.74 20.93,-210.06 184.09,-378.37 392.05,-407.74 -207.98,-29.38 -371.16,-197.69 -392.06,-407.78z"
          class="fil0"
        ></path>
      </g>
    </svg>
  </div>
</button>

</div>
</div>
</div>
</div>
</div>



<style>
    .filter-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(63, 63, 63, 0.703);
        z-index: 1;
    }
    .site-blocks-cover {
        position: relative;
    }
    /* From Uiverse.io by dalbrechtmartin */
    button {
        position: relative;
        padding: 10px 35px;
        background: #ffffff;
        font-size: 15px;
        font-weight: 900;
        color: #333333;
        box-shadow: 0px 0px 10px 0px rgb(255, 255, 255);
        border-radius: 50px;
        border: none;
        transition: all 0.3s ease-in-out;
        cursor: pointer;
    }

    .star-1 {
        position: absolute;
        top: 20%;
        left: 20%;
        width: 25px;
        height: auto;
        filter: drop-shadow(0 0 0 #fffdef);
        z-index: -5;
  transition: all 0.8s cubic-bezier(0.05, 0.83, 0.43, 0.96);
}

.star-2 {
    position: absolute;
    top: 45%;
    left: 45%;
    width: 15px;
    height: auto;
    filter: drop-shadow(0 0 0 #fffdef);
    z-index: -5;
    transition: all 0.8s cubic-bezier(0, 0.4, 0, 1.01);
}

.star-3 {
  position: absolute;
  top: 40%;
  left: 40%;
  width: 5px;
  height: auto;
  filter: drop-shadow(0 0 0 #fffdef);
  z-index: -5;
  transition: all 0.8s cubic-bezier(0, 0.4, 0, 1.01);
}

.star-4 {
    position: absolute;
    top: 20%;
    left: 40%;
    width: 8px;
    height: auto;
    filter: drop-shadow(0 0 0 #fffdef);
    z-index: -5;
    transition: all 0.8s cubic-bezier(0, 0.4, 0, 1.01);
}

.star-5 {
    position: absolute;
    top: 25%;
    left: 45%;
    width: 15px;
    height: auto;
    filter: drop-shadow(0 0 0 #fffdef);
    z-index: -5;
    transition: all 0.8s cubic-bezier(0, 0.4, 0, 1.01);
}
a{
    text-decoration: none;
}
.star-6 {
    position: absolute;
    top: 5%;
    left: 50%;
    width: 5px;
    height: auto;
    filter: drop-shadow(0 0 0 #fffdef);
    z-index: -5;
    transition: all 0.8s cubic-bezier(0, 0.4, 0, 1.01);
}

/* button:hover {
    background: #000000;
    color: #ffffff;
    box-shadow: 0 0 80px #ffffff8c;
    } */

    button:hover .star-1 {
  position: absolute;
  top: -20%;
  left: -20%;
  width: 20px;
  height: auto;
  filter: drop-shadow(0 0 10px #fffdef);
  z-index: 2;
}

button:hover .star-2 {
    position: absolute;
    top: 35%;
    left: -25%;
    width: 15px;
    height: auto;
    filter: drop-shadow(0 0 10px #fffdef);
    z-index: 2;
}

button:hover .star-3 {
    position: absolute;
    top: 80%;
    left: -10%;
    width: 10px;
    height: auto;
    filter: drop-shadow(0 0 10px #fffdef);
    z-index: 2;
}

button:hover .star-4 {
    position: absolute;
    top: -25%;
    left: 105%;
    width: 20px;
    height: auto;
    filter: drop-shadow(0 0 10px #fffdef);
    z-index: 2;
}

button:hover .star-5 {
    position: absolute;
    top: 30%;
    left: 115%;
    width: 15px;
    height: auto;
    filter: drop-shadow(0 0 10px #fffdef);
    z-index: 2;
}

button:hover .star-6 {
    position: absolute;
    top: 80%;
    left: 105%;
    width: 10px;
  height: auto;
  filter: drop-shadow(0 0 10px #fffdef);
  z-index: 2;
}

.fil0 {
    fill: #fffdef;
}

</style>
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5">
                <video width="100%" height="auto" style="max-height: 400px; object-fit: cover; borderborder:#5b5a5a solid 2px" autoplay muted loop>
                    <source src="salon_f.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
         </div>
        <div class="col-lg-6 bg-white p-md-5 align-self-center" style="border:#5b5a5a dashed  2px">
          <h2 class="display-1  line-height-1 site-section-heading mb-4 pb-3 ">about us</h2>
          <p class="text-black lead">
            <h5>&ldquo; Salonak is a website that allows you to book appointments at various salons regardless of their geographical location. Enjoy competitive and affordable prices at times that suit you, with the opportunity to receive multiple discounts. You can also view experiences and reviews from others before making your booking.&rdquo;</h5>
        </p>
        <p class="lead text-black">
            <button style="background-color:  rgba(63, 63, 63, 0.703); border-radius: 10px; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                See more about this website
            </button>
        </p>
  </div>
    </div>
    </div>
</div>


</div>
<div class="site-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-z">
                <h2 class="site-section-heading font-weight-light text-black text-center">Featured salons</h2>
        </div>
    </div>
    @php
    $count = $subsalons->count();
@endphp

<div class="row">
    @if ($count === 1)
        @for ($i = 0; $i < 4; $i++)
            <div class="col-md-6 col-lg-3 text-center mb-1">
                <div class="h-70 bg-light site-block-feature-7">
                    <img src="{{ $subsalons->first()->salon->image }}" alt="Image" class="img-fluid"
                         style="width: 100%; height: 300px; object-fit: cover;">
                    <div class="p-3 ">
                        <h3 class="h4">{{ $subsalons->first()->name }}</h3>
                        <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                        <a href="{{ route('single_salon', $subsalons->first()) }}">
                            <button class="font-weight-bold">See More</button>
                        </a>
                    </div>
                </div>
            </div>
        @endfor
    @else
        @foreach ($subsalons->slice(0, 8) as $subsalon)
            <div class="col-md-6 col-lg-3 text-center mb-5">
                <div class="h-70 bg-light site-block-feature-7">
                    <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid"
                         style="width: 100%; height: 300px; object-fit: cover;">
                    <div class="p-3 ">
                        <h3 class="h4">{{ $subsalon->name }}</h3>
                        <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                        <a href="{{ route('single_salon', $subsalon) }}">
                            <button class="font-weight-bold">See More</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
</div>
</div>
</div>


@if ($subsalons->isEmpty())
    <p>No sub-salons found.</p>
@endif


      {{-- <div class="row">
        @foreach ($subsalons->slice(0, 3) as $subsalon)
        <div class="col-md-6 col-lg-4 text-center mb-5 mb-lg-5">
            <div class="h-70 bg-light site-block-feature-7">
                    <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid"
                        style="width: 400px; height: 300px; object-fit: cover;">
                    <div class="p-3 ">
                        <h3 class=" h4 ">{{ $subsalon->name }}</h3>
                        <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional hairstylists and artists ensures you achieve a stunning and distinctive look. From trendy haircuts to </p>
                        <a href="{{ route('single_salon', $subsalon) }}">
                            <button class="font-weight-bold ">See More</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        @if ($subsalons->isEmpty())
            <p>No sub-salons found.</p>
        @endif
    </div>
</div> --}}
<div class="site-section">
    <div class="container">
      <div class="row justify-content-center mb-5">
        <div class="col-md-7">
          <h2 class="site-section-heading font-weight-light text-black text-center">more of salons</h2>
        </div>
      </div>
      @php
      $count = $subsalons->count();
  @endphp

  <div class="row">
      @if ($count === 1)
          @for ($i = 0; $i < 4; $i++)
              <div class="col-md-6 col-lg-3 text-center mb-5">
                  <div class="h-70 bg-light site-block-feature-7">
                      <img src="{{ $subsalons->first()->salon->image }}" alt="Image" class="img-fluid"
                           style="width: 100%; height: 300px; object-fit: cover;">
                      <div class="p-3 ">
                          <h3 class="h4">{{ $subsalons->first()->name }}</h3>
                          <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                          <a href="{{ route('single_salon', $subsalons->first()) }}">
                              <button class="font-weight-bold">See More</button>
                          </a>
                      </div>
                  </div>
              </div>
          @endfor
      @else
          @foreach ($subsalons->slice(0, 8) as $subsalon)
              <div class="col-md-6 col-lg-3 text-center mb-5">
                  <div class="h-70 bg-light site-block-feature-7">
                      <img src="{{ $subsalon->salon->image }}" alt="Image" class="img-fluid"
                           style="width: 100%; height: 300px; object-fit: cover;">
                      <div class="p-3 ">
                          <h3 class="h4">{{ $subsalon->name }}</h3>
                          <p>At Glamour Touch Salon, we offer you a unique experience in beauty care. Our team of professional  </p>
                          <a href="{{ route('single_salon', $subsalon) }}">
                              <button class="font-weight-bold">See More</button>
                          </a>
                      </div>
                  </div>
              </div>
          @endforeach
      @endif
  </div>
  </div>
  </div>
  </div>


  @if ($subsalons->isEmpty())
      <p>No sub-salons found.</p>
  @endif






<div class="site-section">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-lg-4 text-start">
          <h3 class="line-height-1 mb-3">
              <span class="d-block display-4 line-height-1 text-black">Contact us with</span>
              <span class="d-block display-4 line-height-1"><em class=" font-weight-bold">salonak</em></span>
          </h3>
          <p>
            We’re here to help! If you have any questions or feedback, please don’t hesitate to reach out. The "Your Salon" team is eager to assist you and answer any inquiries you may have.
        </p>
          <div>
            <a href="mailto:info@example.com"><i class="fas fa-envelope"></i> Email</a><br>
            <a href="https://www.facebook.com/fakepage" target="_blank"><i class="fab fa-facebook"></i> Facebook</a><br>
            <a href="https://www.twitter.com/fakeaccount" target="_blank"><i class="fab fa-twitter"></i> Twitter</a><br>
            <a href="https://www.instagram.com/fakeprofile" target="_blank"><i class="fab fa-instagram"></i> Instagram</a><br>
            <a href="https://www.linkedin.com/fakeprofile" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <figure class="h-100 hover-bg-enlarge">
            <div class="bg-image h-100 bg-image-md-height" style="background-image: url('images/img_2.jpg');"></div>
          </figure>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="border p-4 d-flex h-100">
              <div class="row">
                  <form action="" method="POST">
                      @csrf
                      <div class="form-group">
                          <label for="name">Name</label>
                          <input type="text" id="name" name="name" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" id="email" name="email" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label for="message">Message</label>
                          <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
                      </div>
                      <button type="submit" class="btn ">Send Message</button>
                  </form>
              </div>
          </div>
        </div>
      </div>
    </div>
</div>



@endsection
