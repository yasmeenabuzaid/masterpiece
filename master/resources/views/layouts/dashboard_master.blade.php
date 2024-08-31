<!-- first include start -->
@include("include/dashboard/first")
<!-- first include end -->
<div class="container-scroller">

    <!-- start mobile navbar -->
    @include("include/dashboard/mobile_navbar")
    <!-- end mobile navbar -->
    <div class="container-fluid page-body-wrapper">
        <!-- include nav bar start -->
        @include("include/dashboard/sidebar")
        <!-- include nav bar end -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="mdi mdi-home"></i>
                        </span> @yield("headTitle" , "mustafa")
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">
                                <span></span>Overview <i
                                    class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                            </li>
                        </ul>
                    </nav>
                </div>
                @yield("content")
            </div>
            <!-- content-wrapper ends -->

            <!-- include end start -->
            @include("include/dashboard/end")
            <!-- include end END -->
