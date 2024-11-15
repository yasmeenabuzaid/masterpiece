@extends('layouts.dashboard_master')

@section('content')

    <div class="row">
        @php
            $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin();
            $isOwner = auth()->check() && auth()->user()->isOwner();
        @endphp

<div class="row">
    @php
        $isSuperAdmin = auth()->check() && auth()->user()->isSuperAdmin();
        $isOwner = auth()->check() && auth()->user()->isOwner();
    @endphp

    <!-- Card for Salons -->
    @if ($isSuperAdmin)
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

    <!-- Card for Sub Salons -->
    @if ($isSuperAdmin || $isOwner)
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

    <!-- Card for Owners -->
    @if ($isSuperAdmin)
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <span class="font-weight-normal mb-3 h3"><b>Owners</b></span>
                <i class="mdi mdi-account-box mdi-24px"></i>
                <h2 class="mb-5">{{ count($owners ?? []) }}</h2>
            </div>
        </div>
    </div>
    @endif

    <!-- Card for Employees -->
    @if ($isSuperAdmin || $isOwner)
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <span class="font-weight-normal mb-3 h3"><b>Employees</b></span>
                <i class="mdi mdi-account-tie mdi-24px"></i>
                <h2 class="mb-5">{{ count($employees ?? []) }}</h2>
            </div>
        </div>
    </div>
    @endif

    <!-- Card for Categories -->
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

    <!-- Card for Feedbacks -->
    @if ($isSuperAdmin || $isOwner)
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

    <!-- Card for Customers -->
    <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <span class="font-weight-normal mb-3 h3"><b>Customers</b></span>
                <i class="mdi mdi-account-multiple mdi-24px"></i>
                <h2 class="mb-5">{{ count($customers ?? []) }}</h2>
            </div>
        </div>
    </div>

    <!-- Card for Bookings -->
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
</div>
    <div class="row">


      </div>
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
    @endsection

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <script>
        window.onload = function () {
            // عرض مخطط Area Chart
            var ctxArea = document.getElementById('areaChart').getContext('2d');
            var areaChart = new Chart(ctxArea, {
                type: 'line',  // نستخدم النوع "line" لمخطط المساحة
                data: {
                    labels: [
                        // @foreach($subSalonNames as $subSalonName)
                        //     '{{ $subSalonName }}',  // اسم الصالون الفرعي
                        // @endforeach
                    ],
                    datasets: [{
                        label: 'Bookings per Sub Salon',  // تسمية البيانات
                        data: [
                            @foreach($subSalonBookings as $bookingCount)
                                {{ $bookingCount }} ,
                            @endforeach
                        ],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',  // اللون الخلفي
                        borderColor: 'rgba(75, 192, 192, 1)',  // اللون للحدود
                        borderWidth: 1,
                        fill: true,  // لملء المساحة تحت الخط
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,  // بدء المحور Y من الصفر
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

            // عرض مخطط Bar Chart
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
    </script> --}}
    {{-- @endpush
    @stack('scripts')
@endsection --}}
