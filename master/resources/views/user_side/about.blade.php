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

            <div class="col-md-6 ">
                <img src="https://media.istockphoto.com/id/2173348693/photo/barbershop-tools-set-scissors-shaving-machine-comb-and-trimmer-lie-on-a-gray-background.jpg?s=612x612&w=0&k=20&c=Syzj8EPLZ3JRMvQOr8e7sFR1VkzP0w3rtjiZELBHR_Y=" class="img-fluid mb-4" style="max-width: 100%; height: auto;">

            </div>
        </div>
    </section>






<section class="section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 mb-5">
                <img src="https://images.pexels.com/photos/7697393/pexels-photo-7697393.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" alt="Image placeholder" class="img-fluid mb-4" style="width:600px;hight:600px">
                <p>Through "Salonek," you can read reviews and feedback from other clients, helping you make the right decision before booking your appointment. We believe that transparency and convenience are key to a great customer experience.</p>



            </div>

            <div class="col-md-6 mb-5">
                <img src="https://images.pexels.com/photos/13714797/pexels-photo-13714797.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load" class="img-fluid mb-4" style="max-width: 100%; height: auto;">

                <ul class="list-unstyled check">
                    <ul class="list-unstyled check">
                        <p class="mb-3">"Salonek" was born out of a simple idea to make beauty and wellness services more accessible and convenient for everyone. We wanted to create a platform that brings all the best salons together in one place, allowing customers to book their services easily and confidently.</p>

                        <li>Easily choose from a wide range of services</li>
                        <li>Book an appointment that fits your schedule and the salon's availability</li>
                        <li>Benefit from transparency with genuine client reviews</li>
                    </ul>


            </div>
        </div>
    </div>
</section>

</section>

@endsection
