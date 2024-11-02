<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: rgb(59, 56, 67); color: #fff; padding:10px 15px;">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('count')}}">
                <span style=" color: #fff;"  class="menu-title">home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('salons.index')}}">
                <span style=" color: #fff;"  class="menu-title">salons</span>
                <i class="fa-solid fa-shop menu-icon"></i>

            </a>

        </li>
        @endif


    @if (auth()->check() && (auth()->user()->isSuperAdmin()||auth()->user()->isOwner() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('subsalons.index')}}">
                <span  style=" color: #fff;"  class="menu-title">sub-salons</span>
                <i class="fa-solid fa-timeline menu-icon"></i>
            </a>
        </li>
    @endif


    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('working_hours.index')}}">
            <span  style=" color: #fff;"  class="menu-title">working hours</span>
            <i class="mdi mdi-collage menu-icon"></i>
        </a>
    </li> --}}

    @if (auth()->check() && (auth()->user()->isSuperAdmin() ))

    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-title" style=" color: #fff;">users</span>
          <i class="menu-arrow"></i>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" style=" color: #fff;" href="{{route('users.index')}}">all users</a></li>
            <li class="nav-item"> <a class="nav-link" style=" color: #fff;" href="{{ route('superAdmins.index') }}">super admin</a></li>
            <li class="nav-item"> <a class="nav-link" style=" color: #fff;" href="{{ route('owners.index') }}">owners</a></li>
            <li class="nav-item"> <a class="nav-link" style=" color: #fff;" href="{{ route('employees.index') }}">employees</a></li>
            <li class="nav-item"> <a class="nav-link" style=" color: #fff;"  href="{{ route('castomors.index') }}">customers</a></li>
          </ul>
        </div>
      </li>
    @endif
          <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <span  style=" color: #fff;"  class="menu-title">categories</span>
                <i class="mdi mdi-collage menu-icon"></i>
            </a>
        </li>

    <li class="nav-item">
        <a class="nav-link" href="{{route('services.index')}}">
            <span style=" color: #fff;"  class="menu-title">services</span>
            <i class="fa-solid fa-server menu-icon"></i>
        </a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="{{route('bookings.index')}}">
          <span style=" color: #fff;"  class="menu-title">bookings</span>
          <i class="fa-solid fa-calendar-days menu-icon"></i>
      </a>
  </li> --}}

  @if (auth()->check() && (auth()->user()->isSuperAdmin() ||auth()->user()->isOwner() ))
  <li class="nav-item">
      <a class="nav-link" href="{{route('contacts.index')}}">
          <span class="menu-title" style=" color: #fff;">contact us</span>
          <i class="fa-solid fa-square-poll-horizontal menu-icon"></i>
      </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="">
            <span style=" color: #fff;"  class="menu-title">testimonial</span>
            <i class="fa-solid fa-server menu-icon"></i>
        </a>
    </li>
    {{-- {{route('home.index')}} --}}
    <li class="nav-item">
        <a class="nav-link" href="{{route('all_subsalons')}}">
            <span style=" color: #fff;"  class="menu-title">logout</span>
            <i class="fa-solid fa-server menu-icon"></i>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="">
            <span style="color: #fff;" class="menu-title">testimonial</span>
            <i class="fa-solid fa-server menu-icon"></i>
        </a>
    </li> --}}


    </ul>
</nav>
<!-- partial -->
