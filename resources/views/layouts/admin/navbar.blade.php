<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>

    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item">

            @if (Auth::user()->profile_picture)
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture"
                    class="rounded-circle me-2" width="36" height="36">
            @else
                <img src="{{ asset('img/User_Placeholder.png') }}" alt="Default Profile Picture"
                    class="rounded-circle me-2" width="36" height="36">
            @endif

            <span class="d-none d-lg-inline-flex">
                {{ Auth::user()->name }}
            </span>
            </a>
        </div>
    </div>
</nav>
