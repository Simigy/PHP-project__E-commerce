<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    
    <style>
        body {
            background-color: #191c24;
            color: white;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #191c24;
            border-right: 1px solid rgba(255,255,255,0.1);
            padding: 20px 0;
            z-index: 1000;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        
        .nav-link {
            color: white;
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 5px;
            display: flex;
            align-items: center;
        }
        
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .nav-link.active {
            background-color: #0f1015;
        }
        
        .nav-link i {
            margin-right: 10px;
            font-size: 20px;
        }
        
        .language-switcher {
            position: fixed;
            top: 15px;
            right: 15px;
            z-index: 1001;
            background-color: #28a745;
            padding: 10px 15px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.3);
        }
        
        .language-switcher a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            margin: 0 5px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo img {
            max-width: 150px;
        }
        
        .card {
            background-color: #191c24;
            border: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }
        
        .card-header {
            background-color: rgba(255,255,255,0.05);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>
<body>
    <!-- Language Switcher -->
    <div class="language-switcher">
        <a href="{{ url('/language/en') }}">English</a> | 
        <a href="{{ url('/language/ar') }}">العربية</a>
    </div>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo">
        </div>
        
        <div class="sidebar-header">
            <h3>Admin Panel</h3>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ request()->is('simple-admin') ? 'active' : '' }}">
                <a href="{{ route('simple-admin.dashboard') }}">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('simple-admin/products') ? 'active' : '' }}">
                <a href="{{ route('simple-admin.products') }}">
                    <i class="mdi mdi-package-variant"></i>
                    <span>All Products</span>
                </a>
            </li>
            <li class="{{ request()->is('simple-admin/products/create') ? 'active' : '' }}">
                <a href="{{ route('simple-admin.products.create') }}">
                    <i class="mdi mdi-plus-circle"></i>
                    <span>Add Product</span>
                </a>
            </li>
        </ul>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>@yield('title', 'Dashboard')</h4>
                        </div>
                        <div class="card-body">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html> 