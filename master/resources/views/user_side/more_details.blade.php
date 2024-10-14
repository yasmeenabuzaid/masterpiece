@extends('layouts.app-user')

@section('content')
<style>
    .overflow-hidden {
        width: 100%;
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .overflow-hidden img {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
    }
    /* .overflow-hidden img:hover {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
    } */
    .service-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* يوزع المحتوى بشكل متساوي */
    height: 100%; /* يضمن أن كل عنصر يأخذ نفس الارتفاع */
    min-height: 300px; /* تحديد ارتفاع أدنى لكل عنصر */
}

.service-item .btn {
    margin-top: auto; /* يجبر الزر على الانتقال إلى أسفل العنصر */
}
.ser-des{
    height: 50%;
}

.ser_curd {
    border-radius: 8px;
    padding: 20px;
    transition: transform 0.3s, box-shadow 0.3s;
     height: 0%;
}

.ser_curd:hover {
    transform: translateY(2px);
    box-shadow: 0 8px 20px rgba(88, 88, 88, 0.4);
}

</style>
<!-- Carousel Start -->
<div class="container-fluid p-0  " >
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 mt-1">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                        <div class="position-relative h-100">
                            <img src="{{ asset($subsalon->image) }}" alt="" style="object-fit: cover; height: 500px; width: 100%;">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                        {{-- <h6 class="section-title bg-white text-start text-primary pe-3">About Glamour Salon</h6> --}}
                        <h1 class="mb-4">Welcome to {{ ($subsalon->name) }} salon</h1>
                        <p class="mb-4">{{ ($subsalon->description) }}</p>
                        <p class="mb-4">Our platform offers seamless appointment booking and access to a variety of services, ensuring you find exactly what you need. We pride ourselves on delivering exceptional customer service and high-quality treatments.</p>

                        <h6 class="mt-4">Business Hours:</h6>
                        <p class="mb-4">Monday to Friday: 9 AM - 8 PM<br>Saturday: 10 AM - 6 PM<br>Sunday: Closed</p>

                        <div class="row gy-2 gx-4 mb-4">
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Expert Stylists</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Easy Online Booking</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Transparent Pricing</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="mb-0"><i class="fa fa-check text-primary me-2"></i>Customer Reviews</p>
                            </div>
                        </div>
                    </div>

                        {{-- <a class="btn btn-primary py-3 px-5 mt-2" href="">Learn More</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xxl">
            <div class="container">
                <div class="row g-4">
                    <!-- Service: Appointment Booking -->
                    <div class="col-lg-4 col-sm-6 wow fadeInUp ser_curd" data-wow-delay="0.1s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-calendar-check mb-4" style="color: #1d1d1d"></i>
                                <div class="ser-des">
                                    <h5 class="mb-3">Appointment Booking</h5>
                                    <p>Effortlessly book your appointments online with the best salons.</p>
                                </div>
                                <a href="{{ route('all-categories', $subsalon) }}" class="btn" style="background-color: #1d1d1d; color: white">Book Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Service: Contact Manager -->
                    <div class="col-lg-4 col-sm-6 wow fadeInUp ser_curd" data-wow-delay="0.3s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-envelope mb-4" style="color: #1d1d1d"></i>
                                <div class="ser-des">
                                    <h5 class="mb-3">Contact Manager</h5>
                                    <p>For any inquiries, reach out directly to the manager.</p>
                                </div>
                                <a class="btn mt-4" style="background-color: #1d1d1d; color: white">Contact Now</a>
                            </div>
                        </div>
                    </div>
                    <!-- Service: View More Work -->
                    <div class="col-lg-4 col-sm-6 wow fadeInUp ser_curd" data-wow-delay="0.5s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="fa fa-3x fa-image mb-4" style="color: #1d1d1d"></i>
                                <div class="ser-des">
                                    <h5 class="mt-4">View More Work</h5>
                                    <p>Explore our previous work and get inspired.</p>
                                </div>
                                <a href="{{ route('more_images') }}" class="btn" style="background-color: #1d1d1d; color: white">View Work</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



<!-- Service End -->



    </div>
</div>
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Distinctive salon works</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="https://i.pinimg.com/236x/86/fb/74/86fb742948c4e3d540fb68471979ea1f.jpg" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            {{-- <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div> --}}
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKxrlTNR2MdOeBNVyLGJbZ0Y1uKUwCRYxGNA&s" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            {{-- <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div> --}}
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTDI-m2jqrPKUigRqbC9kzWeQVtZMhI8sGO9Q&s" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            {{-- <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div> --}}
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSWjqAnwFMA_Oq9Wam44KC-wL2W3ZAXIHeCLQ&s" alt="">
                        </div>
                        <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                            {{-- <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
                            </div> --}}
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Instructor Name</h5>
                            <small>Designation</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->
<!-- Carousel End -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
            <h1 class="mb-5">Images of Salon</h1>
        </div>
        <div class="row g-3">
            <div class="col-lg-7 col-md-6">
                <div class="row g-3">
                    <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="https://i.pinimg.com/236x/3b/5b/7d/3b5b7d50b92bb2290361ec37f3ce4cf2.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Web Design</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="https://i.pinimg.com/236x/c3/c0/d0/c3c0d095ef705f002dc66d6ccb674e8a.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Graphic Design</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                        <a class="position-relative d-block overflow-hidden" href="">
                            <img class="img-fluid" src="https://i.pinimg.com/enabled/564x/33/cb/2f/33cb2f839693719c4fbe2eca30dcf0a2.jpg" alt="">
                            <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                                <h5 class="m-0">Video Editing</h5>
                                <small class="text-primary">49 Courses</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                <a class="position-relative d-block h-100 overflow-hidden" href="">
                    <img class="img-fluid position-absolute w-100 h-100" src="https://i.pinimg.com/enabled/564x/e9/ca/5c/e9ca5caa20055fe6e7684428e73ff780.jpg" alt="" style="object-fit: cover;">
                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3" style="margin: 1px;">
                        <h5 class="m-0">Online Marketing</h5>
                        <small class="text-primary">49 Courses</small>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

    </div>
</div>


 <!-- About End -->


    <!-- Categories Start -->
    <!-- Categories Start -->


@endsection
