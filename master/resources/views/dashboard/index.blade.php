@extends('layouts.dashboard_master')

@section('content')
    <div class="row">
        @php
            $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin();
            $isOwner = auth()->check() && auth()->user()->isOwner();
        @endphp

        @if ($isSuperAdmin)
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>Salons</b></span>
                        <i class="mdi mdi-animation mdi-24px"></i>
                        <h2 class="mb-5">{{ count($salons ?? []) }}</h2>
                    </div>
                </div>
            </div>
        @endif

        @if ($isSuperAdmin || $isOwner)
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>Sub Salons</b></span>
                        <i class="mdi mdi-airplane mdi-24px"></i>
                        <h2 class="mb-5">{{ count($subsalons ?? []) }}</h2>
                    </div>
                </div>
            </div>
          @endif
          @if ($isSuperAdmin)
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>Owners</b></span>
                        <i class="mdi mdi-bookmark-outline mdi-24px"></i>
                        <h2 class="mb-5">{{ count($owners ?? []) }}</h2>
                    </div>
                </div>
            </div>
          @endif
         @if ($isSuperAdmin || $isOwner)

            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>Employees</b></span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($employees ?? []) }}</h2>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Sub Categories</b></span>
                    <i class="mdi mdi-book mdi-24px"></i>
                    <h2 class="mb-5">{{ count($subcategories ?? []) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Categories</b></span>
                    <i class="mdi mdi-book mdi-24px"></i>
                    <h2 class="mb-5">{{ count($categories ?? []) }}</h2>
                </div>
            </div>
        </div>

        @if ($isSuperAdmin || $isOwner)
            <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                    <div class="card-body">
                        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                        <span class="font-weight-normal mb-3 h3"><b>Feedbacks</b></span>
                        <i class="mdi mdi-book mdi-24px"></i>
                        <h2 class="mb-5">{{ count($feedbacks ?? []) }}</h2>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Customers</b></span>
                    <i class="mdi mdi-book mdi-24px"></i>
                    <h2 class="mb-5">{{ count($customers ?? []) }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Bookings</b></span>
                    <i class="mdi mdi-book mdi-24px"></i>
                    <h2 class="mb-5">{{ count($bookings ?? []) }}</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
