<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css') }}">

    <!-- Inline critical styles -->
    <style>
        :root {
            --body-bg: #191c24;
            --card-bg: #191c24;
            --border-color: rgba(255,255,255,0.1);
        }

        body {
            background-color: var(--body-bg) !important;
            color: #ffffff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .navbar .navbar-nav {
            padding-right: 0;
        }

        [dir="rtl"] .ms-auto {
            margin-left: unset !important;
            margin-right: auto !important;
        }

        [dir="rtl"] .me-auto {
            margin-right: unset !important;
            margin-left: auto !important;
        }

        [dir="rtl"] .ms-2 {
            margin-left: unset !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .me-2 {
            margin-right: unset !important;
            margin-left: 0.5rem !important;
        }

        [dir="rtl"] .dropdown-menu-end {
            right: auto !important;
            left: 0 !important;
        }

        [dir="rtl"] .text-end {
            text-align: left !important;
        }

        [dir="rtl"] .text-start {
            text-align: right !important;
        }

        /* Core layout components */
        [dir="rtl"] .sidebar {
            right: 0;
            left: auto;
        }

        [dir="rtl"] .main-panel {
            margin-right: 244px;
            margin-left: 0;
        }

        /* Icons and buttons */
        [dir="rtl"] .mdi {
            margin-left: 0.5rem;
            margin-right: 0;
        }

        [dir="rtl"] .btn i {
            margin-left: 0.3rem;
            margin-right: 0;
        }

        /* Core styles */
        .sidebar,
        .navbar,
        .footer {
            background: var(--body-bg) !important;
        }

        /* Sidebar specific styles */
        .sidebar {
            min-height: 100vh;
            padding: 0;
            width: 244px;
            z-index: 11;
            transition: width 0.25s ease, background 0.25s ease;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
        }

        .sidebar .nav .nav-item .nav-link i {
            color: inherit;
        }

        .sidebar .nav .nav-item .nav-link .menu-icon {
            margin-right: 1.125rem;
            font-size: 1.125rem;
            line-height: 1;
            background: rgba(255, 255, 255, 0.1);
            width: 35px;
            height: 35px;
            border-radius: 50%;
            text-align: center;
            padding-top: 8px;
        }

        .sidebar-brand-wrapper {
            height: 70px;
            background: var(--body-bg);
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand-wrapper .sidebar-brand {
            padding: 1rem 0;
            display: block;
        }

        .sidebar-brand-wrapper .sidebar-brand.brand-logo-mini {
            display: none;
        }

        .sidebar-brand-wrapper .sidebar-brand img {
            width: 140px;
            max-width: 100%;
            height: auto;
        }

        /* Navbar specific styles */
        .navbar {
            position: fixed;
            width: calc(100% - 244px);
            margin-left: 244px;
            z-index: 10;
            padding: 1rem;
            transition: all 0.25s ease;
        }

        [dir="rtl"] .navbar {
            margin-left: 0;
            margin-right: 244px;
        }

        .navbar .navbar-menu-wrapper {
            color: #ffffff;
        }

        .navbar .navbar-brand-wrapper {
            background: var(--body-bg);
        }

        .navbar-profile {
            display: flex;
            align-items: center;
        }

        .navbar-profile img {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .navbar-profile p {
            margin: 0;
            font-size: 14px;
            font-weight: 500;
        }

        /* Content wrapper styles */
        .content-wrapper {
            padding: 2rem;
            margin-top: 70px;
            margin-left: 244px;
            min-height: calc(100vh - 70px);
            background: var(--body-bg);
        }

        [dir="rtl"] .content-wrapper {
            margin-left: 0;
            margin-right: 244px;
        }

        /* Dropdown styles */
        .dropdown-menu {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            color: #ffffff;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }

        .dropdown-divider {
            border-color: var(--border-color);
        }

        /* Card styles */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
        }

        .card-header {
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid var(--border-color);
        }

        /* Corona gradient card */
        .corona-gradient-card {
            background-image: linear-gradient(to left, #d41459, #911a6c) !important;
            border-radius: 6px !important;
        }
    </style>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    @stack('styles')
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        
        <!-- Main Panel -->
        <div class="main-panel">
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
            
            <!-- Footer -->
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>

    <!-- Plugin js -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>

    <!-- Custom js -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>

    @stack('scripts')
</body>
</html>
