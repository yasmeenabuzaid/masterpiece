        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
{{--            <li class="nav-item nav-profile">--}}
{{--              <a href="#" class="nav-link">--}}
{{--                <div class="nav-profile-image">--}}
{{--                  <img src="/assets/images/faces/face1.jpg" alt="profile">--}}
{{--                  <span class="login-status online"></span>--}}
{{--                  <!--change to offline or busy as needed-->--}}
{{--                </div>--}}
{{--                <div class="nav-profile-text d-flex flex-column">--}}
{{--                  <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>--}}

{{--                </div>--}}
{{--                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>--}}
{{--              </a>--}}
{{--            </li>--}}
            <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('categories.index')}}">
                <span class="menu-title">Category</span>
                <i class="mdi mdi-collage menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('trips.index')}}">
                <span class="menu-title">trips</span>
                <i class="mdi mdi-book menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('guides.index')}}">
                <span class="menu-title">guide</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/dash/testimonials')}}">
                <span class="menu-title">testimonials</span>
                <i class="mdi mdi-account-card-details menu-icon"></i>
              </a>
            </li>


          </ul>
        </nav>
        <!-- partial -->
