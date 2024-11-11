<div class="sidebar">
    <!-- Logo Image -->
    <a class="navbar-brand brand-logo" href="index.html">
        <img src="logoindash.png" alt="logo" style="width: 180px; height: 50px;" />
    </a>

    <!-- Sidebar Navigation Links -->
    <ul class="sidebar-nav">
        <li><a href="" class="sidebar-link">Profile</a></li>
        <li><a href="{{ route('my_booking') }}" class="sidebar-link">My Bookings</a></li>
    </ul>
</div>

<style>
/* Sidebar Styles */
.sidebar {
    width: 250px;
    background-color: #4f4f4f; /* Changed to #6c6c6c */
    color: white;
    padding: 20px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    box-sizing: border-box; /* Added to handle padding properly */
}

/* Logo Image Container */
.navbar-brand {
    display: block;
    text-align: center;
    margin-bottom: 30px; /* Add space below logo */
}

/* Sidebar Navigation Styles */
.sidebar-nav {
    list-style: none;
    padding-left: 0;
}

.sidebar-nav li {
    margin-bottom: 15px;
}

.sidebar-link {
    text-decoration: none;
    color: white;
    font-size: 18px;
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.sidebar-link:hover {
    background-color: #34495e;
}

/* Optional: Make the sidebar responsive for small screens */
@media (max-width: 768px) {
    .sidebar {
        width: 200px;
        padding: 15px;
    }

    .sidebar-link {
        font-size: 16px;
    }

    /* Optional: Adjust logo size on smaller screens */
    .navbar-brand img {
        width: 160px; /* Adjust logo size */
    }
}
</style>
