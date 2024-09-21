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

                    </nav>
                </div>
                @yield("content")
            </div>
            <!-- content-wrapper ends -->

            <!-- include end start -->
            @include("include/dashboard/end")
            <!-- include end END -->
