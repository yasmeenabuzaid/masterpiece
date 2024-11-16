@extends('layouts.app-user')

@section('content')

<section class="home-slider inner-page owl-carousel">
    <div class="slider-item" style="background-image: url('https://images.pexels.com/photos/331989/pexels-photo-331989.jpeg?auto=compress&cs=tinysrgb&w=600');">
        <div class="container">
            <div class="row slider-text align-items-center justify-content-center text-center">
                <div class="col-md-7 col-sm-12 element-animate">
                    <h1>Get A Quote</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .home-slider .slider-item {
    position: relative;
}

.home-slider .slider-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(54, 54, 54, 0.57);
    z-index: 1;
}

.home-slider .slider-item .container {
    position: relative;
    z-index: 2;
}

</style>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control form-control-lg" id="fname" name="fname">
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control form-control-lg" id="lname" name="lname">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" class="form-control form-control-lg" name="email">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="phone">Phone</label>
                                <input type="text" id="phone" class="form-control form-control-lg" name="phone">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="message">Say about your salon</label>
                                <textarea name="message" id="message" class="form-control form-control-lg" cols="30" rows="8"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="plan">Choose Your Subscription Plan</label>
                                <select name="plan" id="plan" class="form-control form-control-lg">
                                    <option value="basic">Basic Plan - $29.99/month</option>
                                    <option value="standard">Standard Plan - $49.99/month</option>
                                    <option value="premium">Premium Plan - $79.99/month</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="payment_method">Choose Payment Method</label>
                                <select name="payment_method" id="payment_method" class="form-control form-control-lg">
                                    <option value="credit_card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="submit" value="Send Message" class="btn btn-primary btn-lg btn-block">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-4">
                    <h2 class="text-uppercase heading mb-5 text-left">Choose Your Subscription Plan</h2>

                    <div class="media d-block media-testimonial mb-5 text-left">
                        <img src="img/plan_basic.jpg" alt="Basic Plan" class="img-fluid mb-3">
                        <h3 class="text-primary">Basic Plan</h3>
                        <p><strong>Price:</strong> $29.99/month</p>
                        <p><strong>Features:</strong></p>
                        <ul>
                            <li>Basic salon listing</li>
                            <li>Limited booking options</li>
                            <li>Basic support</li>
                        </ul>
                        <p><strong>Details:</strong> This plan is ideal for smaller salons looking for essential listing and booking services with standard support.</p>
                        <hr>
                    </div>

                    <div class="media d-block media-testimonial mb-5 text-left">
                        <img src="img/plan_standard.jpg" alt="Standard Plan" class="img-fluid mb-3">
                        <h3 class="text-primary">Standard Plan</h3>
                        <p><strong>Price:</strong> $49.99/month</p>
                        <p><strong>Features:</strong></p>
                        <ul>
                            <li>Priority salon listing</li>
                            <li>Unlimited bookings</li>
                            <li>Advanced support</li>
                            <li>Performance analytics</li>
                        </ul>
                        <p><strong>Details:</strong> This plan is perfect for salons that need more flexibility with unlimited bookings and advanced support with performance insights.</p>
                        <hr>
                    </div>

                    <div class="media d-block media-testimonial mb-5 text-left">
                        <img src="img/plan_premium.jpg" alt="Premium Plan" class="img-fluid mb-3">
                        <h3 class="text-primary">Premium Plan</h3>
                        <p><strong>Price:</strong> $79.99/month</p>
                        <p><strong>Features:</strong></p>
                        <ul>
                            <li>Featured salon listing</li>
                            <li>Full access to all features</li>
                            <li>Personalized marketing</li>
                            <li>Priority customer support</li>
                        </ul>
                        <p><strong>Details:</strong> The premium plan is for salons seeking complete access to all features, personalized marketing, and top-tier support.</p>
                        <hr>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
