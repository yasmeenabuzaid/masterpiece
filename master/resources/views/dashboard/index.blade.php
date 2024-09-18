 @extends('layouts.dashboard_master')
    @section('content')
        <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>salons</b>
                        </span><i class="mdi mdi-animation mdi-24px"></i>
                        <h2 class="mb-5">{{ count($salons) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>sub salons</b>
                        </span>
                        <i class="mdi mdi-airplane mdi-24px"></i>
                        <h2 class="mb-5">{{ count($subsalons) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b> owners </b></span>
                        <i class="mdi mdi-bookmark-outline mdi-24px"></i>
                        <h2 class="mb-5">{{ count($owners) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>employees</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($employees) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>sub categories</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($subcategories) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>categories</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($categories) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>feedbacks</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($feedbacks) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>castomors</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($castomors) }}</h2>

                    </div>
                </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>bookings</b> </span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($bookings) }}</h2>

                    </div>
                </div>
            </div>

    @endsection
