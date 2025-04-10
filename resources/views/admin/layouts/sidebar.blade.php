<!-- Sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.corona') }}">
            <img src="{{ asset('Admin/assets/images/logo.svg') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.corona') }}">
            <img src="{{ asset('Admin/assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="count-indicator">
                        <img class="img-xs rounded-circle" src="{{ asset('Admin/assets/images/faces/face15.jpg') }}" alt="">
                        <span class="count bg-success"></span>
                    </div>
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">Henry Klein</h5>
                        <span>Gold Member</span>
                    </div>
                </div>
                <a href="#" id="profile-dropdown" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
                <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-primary"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-onepassword text-info"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-calendar-today text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
                        </div>
                    </a>
                </div>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.corona') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-laptop"></i>
                </span>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.buttons') }}">Buttons</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.dropdowns') }}">Dropdowns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.typography') }}">Typography</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.pages.forms.basic') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-playlist-play"></i>
                </span>
                <span class="menu-title">Form Elements</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.pages.tables.basic') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-table-large"></i>
                </span>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.pages.charts.chartjs') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-chart-bar"></i>
                </span>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.pages.icons.mdi') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-contacts"></i>
                </span>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-icon">
                    <i class="mdi mdi-security"></i>
                </span>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.samples.blank') }}">Blank Page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.samples.404') }}">404</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.samples.500') }}">500</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.samples.login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.pages.samples.register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin-products') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-package-variant-closed"></i>
                </span>
                <span class="menu-title">Products</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin-orders') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-cart"></i>
                </span>
                <span class="menu-title">Orders</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin-reviews') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-star"></i>
                </span>
                <span class="menu-title">Reviews</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin-users') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-account-multiple"></i>
                </span>
                <span class="menu-title">Users</span>
            </a>
        </li>
        <li class="nav-item menu-items">
            <form action="{{ route('logout') }}" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="nav-link btn btn-link w-100 text-left">
                    <span class="menu-icon">
                        <i class="mdi mdi-logout"></i>
                    </span>
                    <span class="menu-title">Log out</span>
                </button>
            </form>
        </li>
    </ul>
</nav>

<style>
    .sidebar {
        width: 244px;
        background: #191c24;
        border-right: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav {
        padding-top: 70px;
    }

    .sidebar .nav .nav-item {
        padding: 0 1rem;
        margin-bottom: 0.5rem;
    }

    .sidebar .nav .nav-item .nav-link {
        color: #8a909d;
        border-radius: 8px;
        display: flex;
        align-items: center;
        padding: 0.875rem 1rem;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    .sidebar .nav .nav-item .nav-link:hover,
    .sidebar .nav .nav-item.active .nav-link {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav .nav-item .menu-icon {
        margin-right: 1rem;
        font-size: 1.125rem;
        line-height: 1;
        width: 35px;
        height: 35px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        text-align: center;
        padding-top: 7px;
    }

    .sidebar .nav .nav-item.active .menu-icon {
        background: rgba(255, 255, 255, 0.2);
    }

    .sidebar .nav .nav-item .menu-title {
        font-size: 0.875rem;
    }

    .sidebar .nav .nav-item .badge {
        margin-left: auto;
    }

    .sidebar .nav .nav-category {
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 500;
        letter-spacing: 0.5px;
        margin: 1rem 0 0.5rem 0;
        padding: 0 1rem;
    }

    .sidebar .sidebar-brand-wrapper {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand {
        width: 100%;
        text-align: center;
    }

    .sidebar .sidebar-brand-wrapper .sidebar-brand img {
        width: 140px;
        max-width: 100%;
    }

    .sidebar .nav .nav-item.profile {
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin-bottom: 1.5rem;
    }

    .sidebar .nav .nav-item.profile .profile-desc {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.675rem 0;
    }

    .sidebar .nav .nav-item.profile .profile-pic {
        display: flex;
        align-items: center;
    }

    .sidebar .nav .nav-item.profile .profile-name {
        margin-left: 1rem;
    }

    .sidebar .nav .nav-item.profile .profile-name h5 {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }

    .sidebar .nav .nav-item.profile .profile-name span {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
    }

    .sidebar .nav .nav-item.profile #profile-dropdown {
        color: #8a909d;
    }

    .sidebar .nav .nav-item.profile #profile-dropdown:hover {
        color: #ffffff;
    }

    .sidebar .nav .nav-item .collapse {
        z-index: 999;
    }

    .sidebar .nav .nav-item .collapse .nav {
        padding-top: 0;
        padding-left: 2.5rem;
    }

    .sidebar .nav .nav-item .collapse .nav .nav-item {
        padding: 0;
    }

    .sidebar .nav .nav-item .collapse .nav .nav-item .nav-link {
        padding: 0.5rem 0;
        font-size: 0.812rem;
        background: transparent;
    }
</style>
