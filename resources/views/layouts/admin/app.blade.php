<!DOCTYPE html>
<html lang="en">

<head>
    {{-- Start Header --}}
    @include('layouts.admin.header')
    {{-- End Header --}}
</head>
@include('layouts.admin.floating-button')
<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        @include('layouts.admin.sidebar')
        <!-- Sidebar End -->

        <div class="content">
            <!-- Navbar Start -->
            @include('layouts.admin.navbar')
            <!-- Navbar End -->

            <!-- Content Start -->
            @yield('content')
            <!-- Content End -->

            <!-- Footer Start -->
            @include('layouts.admin.footer')
            <!-- Footer End -->
        </div>
    </div>

    <!-- Scripts -->
    @include('layouts.admin.js')
    <!-- Script end -->
</body>
</html>
