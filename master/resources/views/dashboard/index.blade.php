@if (auth()->check() && auth()->user()->isSuperAdmin())

@extends('layouts.dashboard_master')

@section('content')

    <div class="row">

        @if (auth()->check() && auth()->user()->isSuperAdmin())
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Salons</b></span>
                    <i class="mdi mdi-store mdi-24px"></i>
                    <h2 class="mb-5">{{ count($salons ?? []) }}</h2>
                </div>
            </div>
        </div>
        @endif

        @if (auth()->check() && auth()->user()->isSuperAdmin() || auth()->user()->isOwner())
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Sub Salons</b></span>
                    <i class="mdi mdi-office-building mdi-24px"></i>
                    <h2 class="mb-5">{{ count($subsalons ?? []) }}</h2>
                </div>
            </div>
        </div>
        @endif

        @if (auth()->check() && auth()->user()->isSuperAdmin())
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Owners</b></span>
                    <i class="mdi mdi-account-box mdi-24px"></i>
                    <h2 class="mb-5">{{$ownersCount  }}</h2>
                </div>
            </div>
        </div>
        @endif

        @if (auth()->check() && auth()->user()->isSuperAdmin() || auth()->user()->isOwner())
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-warning card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Employees</b></span>
                    <i class="mdi mdi-account-tie mdi-24px"></i>
                    <h2 class="mb-5">{{$employeesCount }}</h2>
                </div>
            </div>
        </div>
        @endif

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Categories</b></span>
                    <i class="mdi mdi-tag mdi-24px"></i>
                    <h2 class="mb-5">{{ count($categories ?? []) }}</h2>
                </div>
            </div>
        </div>

        @if (auth()->check() && auth()->user()->isSuperAdmin() || auth()->user()->isOwner())
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Feedbacks</b></span>
                    <i class="mdi mdi-comment-text mdi-24px"></i>
                    <h2 class="mb-5">{{ count($feedbacks ?? []) }}</h2>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->check() && auth()->user()->isSuperAdmin())

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Customers</b></span>
                    <i class="mdi mdi-account-multiple mdi-24px"></i>
                    <h2 class="mb-5">{{ $usersCount }}</h2>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->check() && auth()->user()->isSuperAdmin() || auth()->user()->isOwner())

        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <span class="font-weight-normal mb-3 h3"><b>Bookings</b></span>
                    <i class="mdi mdi-calendar-check mdi-24px"></i>
                    <h2 class="mb-5">{{ count($bookings ?? []) }}</h2>
                </div>
            </div>
        </div>
        @endif
        @if (auth()->check() && auth()->user()->isSuperAdmin())

        <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Booking Distribution by Sub Salon</h4>
                        <canvas id="areaChart" style="height:250px"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Type Distribution</h4>
                        <canvas id="barChart" style="height:230px"></canvas>
                    </div>
                </div>
            </div>
            </div>
@endif


        @endsection


        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
        window.onload = function () {
            var ctxArea = document.getElementById('areaChart').getContext('2d');
            var areaChart = new Chart(ctxArea, {
                type: 'line',
                data: {
                    labels: [
                        @foreach($subSalonNames as $subSalonName)
                        '{{ $subSalonName }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: 'Bookings per Sub Salon',
                        data: [
                            @foreach($subSalonBookings as $bookingCount)
                            {{ $bookingCount }},
                            @endforeach
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' bookings';
                                }
                            }
                        }
                    }
                }
            });

            // Bar Chart
            var ctxBar = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: ['Super Admin', 'Owner', 'Employee', 'User'],
                    datasets: [{
                        label: 'User Types Distribution',
                        data: [
                            {{ $superAdminsCount ?? 0 }},
                            {{ $ownersCount ?? 0 }},
                            {{ $employeesCount ?? 0 }},
                            {{ $usersCount ?? 0 }},
                        ],
                        backgroundColor: '#36A2EB',
                        borderColor: '#36A2EB',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function (tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw + ' users';
                                }
                            }
                        }
                    }
                }
            });
        };
        </script>


</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endif
