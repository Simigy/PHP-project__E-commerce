<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --body-bg: #191c24;
            --card-bg: #191c24;
            --border-color: rgba(255,255,255,0.1);
        }

        body {
            background-color: var(--body-bg);
            color: #ffffff;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* Navbar */
        .navbar {
            background-color: var(--body-bg) !important;
            border-bottom: 1px solid var(--border-color);
            padding: 1rem;
        }

        .navbar-brand img {
            height: 40px;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            padding: 0;
            background-color: var(--body-bg);
            border-right: 1px solid var(--border-color);
            z-index: 100;
            transition: all 0.3s;
        }

        [dir="rtl"] .sidebar {
            left: auto;
            right: 0;
            border-right: none;
            border-left: 1px solid var(--border-color);
        }

        .sidebar .nav-link {
            color: #ffffff;
            padding: 0.8rem 1rem;
            border-radius: 5px;
            margin: 0.2rem 1rem;
            transition: all 0.3s;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
        }

        .sidebar .nav-link i {
            margin-right: 0.5rem;
            width: 24px;
            height: 24px;
            line-height: 24px;
            text-align: center;
        }

        [dir="rtl"] .sidebar .nav-link i {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: calc(100vh - 60px);
        }

        [dir="rtl"] .main-content {
            margin-left: 0;
            margin-right: 250px;
        }

        /* Cards */
        .card {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }

        .card-header {
            background-color: rgba(255,255,255,0.05);
            border-bottom: 1px solid var(--border-color);
        }

        /* Tables */
        .table {
            color: #ffffff;
        }

        .table thead th {
            border-bottom-color: var(--border-color);
        }

        .table td, .table th {
            border-top-color: var(--border-color);
            padding: 1rem;
            vertical-align: middle;
        }

        /* Corona gradient card */
        .corona-gradient-card {
            background-image: linear-gradient(to left, #d41459, #911a6c) !important;
            border-radius: 6px !important;
        }

        /* Stats cards */
        .stats-card {
            background-color: var(--card-bg);
            border-radius: 10px;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.3s;
        }

        .stats-card:hover {
            transform: translateY(-5px);
        }

        .stats-card .icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .stats-card .icon i {
            font-size: 24px;
        }

        /* Dropdowns */
        .dropdown-menu {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
        }

        .dropdown-item {
            color: #ffffff;
        }

        .dropdown-item:hover {
            background-color: rgba(255,255,255,0.1);
            color: #ffffff;
        }

        /* Buttons */
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }

        [dir="rtl"] .me-auto {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .dropdown-menu-end {
            right: auto !important;
            left: 0 !important;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    @include('admin.layouts.navbar')

    <!-- Sidebar -->
    @include('admin.layouts.sidebar')

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Initialize dropdowns
        document.addEventListener('DOMContentLoaded', function() {
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function(dropdown) {
                new bootstrap.Dropdown(dropdown);
            });
        });

        // Toggle sidebar on mobile
        document.querySelector('.navbar-toggler').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('show');
        });
    </script>

    @stack('scripts')
</body>
</html>