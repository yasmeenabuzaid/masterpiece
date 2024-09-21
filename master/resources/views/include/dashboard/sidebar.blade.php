<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{route('count')}}">
                <span class="menu-title">home</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('salons.index')}}">
                <span class="menu-title">salons</span>
                <i class="fa-solid fa-shop menu-icon"></i>

            </a>

        </li>
        @endif
        @if (auth()->check() && (auth()->user()->isSuperAdmin() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('owners.index')}}">
                <span class="menu-title">owners</span>
                <i class="fa-solid fa-user-group  menu-icon "></i>

            </a>
        </li>

    @endif
    @if (auth()->check() && (auth()->user()->isSuperAdmin()||auth()->user()->isOwner() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('subsalons.index')}}">
                <span class="menu-title">sub-salons</span>
                <i class="fa-solid fa-timeline menu-icon"></i>
            </a>
        </li>
    @endif
          <li class="nav-item">
            <a class="nav-link" href="{{route('categories.index')}}">
                <span class="menu-title">categories</span>
                <i class="mdi mdi-collage menu-icon"></i>
            </a>
        </li>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() ||auth()->user()->isOwner() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('employees.index')}}">
                <span class="menu-title">employees</span>
                <i class="fa-solid fa-users-gear  menu-icon"></i>
            </a>
        </li>
    @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('subcategories.index')}}">
                <span class="menu-title">sub categories</span>
                <i class="fa-solid fa-sitemap menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('bookings.index')}}">
                <span class="menu-title">bookings</span>
                <i class="fa-solid fa-calendar-days menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('castomors.index')}}">
                <span class="menu-title">castomors</span>
                {{-- <i class="fa-solid fa-users-rectangle menu-icon"></i> --}}
                <i class="fa-solid fa-users  menu-icon"></i>
            </a>
        </li>
        @if (auth()->check() && (auth()->user()->isSuperAdmin() ||auth()->user()->isOwner() ))
        <li class="nav-item">
            <a class="nav-link" href="{{route('feedbacks.index')}}">
                <span class="menu-title">feedbacks</span>
                <i class="fa-solid fa-square-poll-horizontal menu-icon"></i>
            </a>
        </li>
    @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route('services.index')}}">
                <span class="menu-title">services</span>
                <i class="fa-solid fa-server menu-icon"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->
