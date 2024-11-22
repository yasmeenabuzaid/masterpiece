<nav class="sidebar sidebar-offcanvas" id="sidebar"
    style="background-color: rgb(59, 56, 67); color: #fff; padding:10px 15px;">
    <ul class="nav">
        @if (auth()->check() && auth()->user()->isSuperAdmin())

        <li class="nav-item">
            <a class="nav-link" href="{{ route('count') }}">
                <span style="color: #fff;" class="menu-title">Home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @endif

        @if (auth()->check() && auth()->user()->isSuperAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('salons.index') }}">
                    <span style="color: #fff;" class="menu-title">Salons</span>
                    <i class="fa-solid fa-shop menu-icon"></i>
                </a>
            </li>
        @endif

        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('subsalons.index') }}">
                    <span style="color: #fff;" class="menu-title">Sub-Salons</span>
                    <i class="fa-solid fa-sitemap menu-icon"></i>
                </a>
            </li>
        @endif

        @if (auth()->check() && auth()->user()->isSuperAdmin())
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <span class="menu-title" style="color: #fff;">Users</span>
                    <i class="menu-arrow"></i>
                    <i class="fa-solid fa-users menu-icon"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff;" href="{{ route('users.index') }}">All Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff;" href="{{ route('superAdmins.index') }}">Super
                                Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff;" href="{{ route('owners.index') }}">Owners</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff;" href="{{ route('employees.index') }}">Employees</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="color: #fff;" href="{{ route('castomors.index') }}">Customers</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif
        @if (auth()->check() && auth()->user()->isOwner())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span style="color: #fff;" class="menu-title">Employees</span>
                    <i class="fa-solid fa-tags menu-icon"></i>
                </a>
            </li>
        @endif
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <span style="color: #fff;" class="menu-title">Categories</span>
                    <i class="fa-solid fa-tags menu-icon"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('services.index') }}">
                    <span style="color: #fff;" class="menu-title">Services</span>
                    <i class="fa-solid fa-th-list menu-icon"></i>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('bookings.index') }}">
                <span style="color: #fff;" class="menu-title">Booking</span>
                <i class="fa-solid fa-calendar-check menu-icon"></i>
            </a>
        </li>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() || auth()->user()->isOwner()))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('feedbacks.index') }}">
                    <span style="color: #fff;" class="menu-title">Feedbacks</span>
                    <i class="fa-solid fa-comment-dots menu-icon"></i>
                </a>
            </li>
        @endif
        @if (auth()->check() && auth()->user()->isSuperAdmin())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts.index') }}">
                    <span class="menu-title" style="color: #fff;">Contact Us</span>
                    <i class="fa-solid fa-envelope menu-icon"></i>
                </a>
            </li>
        @endif


        <li class="nav-item">
            <a class="nav-link" href="{{ route('all_subsalons') }}">
                <span style="color: #fff;" class="menu-title">Preview as User</span>
                <i class="fa-solid fa-eye menu-icon"></i>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span style="color: #fff;" class="menu-title">Logout</span>
                <i class="fa-solid fa-sign-out-alt menu-icon"></i>
            </a>
        </li>


    </ul>
</nav>
