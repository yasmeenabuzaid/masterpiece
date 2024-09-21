
<body>
    <!--===== HEADER =====-->
    <header class="header-1" id="header">
      <nav class="nav bd-grid">
        <div class="nav__toggle" id="nav-toggle">
          <i class="bx bxs-grid"></i>
        </div>

        <a href="#" class="nav__logo">Beauty Connect</a>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <li class="nav__item"><a href="#home" class="nav__link active">Home</a></li>
            <li class="nav__item"><a href="#featured" class="nav__link">Booking</a></li>
            {{-- <li class="nav__item"><a href="#women" class="nav__link">Profile</a></li> --}}
            @if (Route::has('login'))
                @auth
                <li class="nav__item"><a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a></li>
                @else
                <li class="nav__item"><a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a></li>

                    @if (Route::has('register'))
                    <li class="nav__item"><a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a></li>
                    @endif
                @endauth

        @endif

          </ul>
        </div>

      </nav>
    </header>
