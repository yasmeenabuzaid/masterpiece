<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: rgb(59, 56, 67); color: #fff;">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background-color: rgb(59, 56, 67); color: #fff;">
        <a class="navbar-brand brand-logo" href="index.html">
            <img src="{{asset('logoindash.png')}}" alt="logo" style="width: 180px; height:50px"/>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="s-logo2.png" alt="logo" style="width: 80px; height:40px"/>
        </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#"></form>
        </div>
        <ul class="navbar-nav navbar-nav-right">
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="mdi mdi-login me-2"></i> Login
                        </a>
                    </li>
                @endif
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="mdi mdi-account-plus me-2"></i> Register
                        </a>
                    </li>
                @endif
            @else
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                            @if(Auth::user()->image)
                                <img src="{{ asset(Auth::user()->image) }}"
                                     alt="Profile Image"
                                     class="img-fluid"
                                     style="width: 90px; height: 30px; border-radius: 50%; border: 2px solid #616161; object-fit: cover;">
                            @else
                                <img src="https://i2.wp.com/chasesolar.org.uk/files/2022/02/blank-avatar.jpg"
                                     alt="Default Profile Image"
                                     style="width: 40px; height: 40px; border-radius: 50%; border: 2px solid #616161; object-fit: cover;">
                            @endif
                        </div>
                        <div class="nav-profile-text">
                            <p class="mb-1" style="color: #fff;">{{ Auth::user()->name }} ({{ Auth::user()->usertype }})</p>
                        </div>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('users.profile') }}">
                            <i class="fa-solid fa-circle-user mdi-cached me-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
