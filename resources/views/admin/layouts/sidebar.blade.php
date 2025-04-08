<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    
    <ul class="nav">
        <!-- Profile -->
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="profile-name">
                        <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                        <span>{{ __('message.Gold Member') }}</span>
                    </div>
                </div>
            </div>
        </li>

        <!-- Navigation Divider -->
        <li class="nav-item nav-category">
            <span class="nav-link">{{ __('message.navigation') }}</span>
        </li>

        <!-- Dashboard -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">{{ __('message.dashboard') }}</span>
            </a>
        </li>

        <!-- Products -->
        <li class="nav-item menu-items {{ request()->routeIs('admin-all-products') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-all-products') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant"></i>
                </span>
                <span class="menu-title">{{ __('message.all_products') }}</span>
                @if(isset($totalProducts) && $totalProducts > 0)
                    <span class="badge badge-success">{{ $totalProducts }}</span>
                @endif
            </a>
        </li>

        <!-- Add Product -->
        <li class="nav-item menu-items {{ request()->routeIs('admin-create-product') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-create-product') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-plus-circle"></i>
                </span>
                <span class="menu-title">{{ __('message.add_product') }}</span>
            </a>
        </li>

        <!-- Orders -->
        <li class="nav-item menu-items {{ request()->routeIs('admin-orders*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-orders') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-cart"></i>
                </span>
                <span class="menu-title">{{ __('message.orders') }}</span>
                @if(isset($totalOrders) && $totalOrders > 0)
                    <span class="badge badge-success">{{ $totalOrders }}</span>
                @endif
            </a>
        </li>

        <!-- Users -->
        <li class="nav-item menu-items {{ request()->routeIs('admin-users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin-users') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">{{ __('message.users') }}</span>
                @if(isset($totalUsers) && $totalUsers > 0)
                    <span class="badge badge-success">{{ $totalUsers }}</span>
                @endif
            </a>
        </li>
    </ul>
</nav>

<div style="margin-left: 250px; padding: 20px;">
    <!-- This div is just a placeholder to push content to the right of the sidebar -->
</div>
