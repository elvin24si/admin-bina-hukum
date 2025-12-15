<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                <img src="{{ Auth::user()->profile_picture
                    ? asset('storage/' . Auth::user()->profile_picture)
                    : asset('img/default-avatar.png') }}"
                    class="rounded-circle me-2" width="36" height="36" alt="Profile">

                <span class="d-none d-lg-inline-flex">
                    {{ Auth::user()->name }}
                </span>
            </a>
        </div>
    </div>
</nav>
