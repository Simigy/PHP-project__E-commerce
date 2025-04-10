<!-- Add CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- partial:partials/_navbar.html -->
<nav class="flex-row p-0 navbar fixed-top d-flex">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('assets/images/logo-mini.svg') }}" alt="logo" />
        </a>
    </div>
    <div class="flex-grow navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
                <form class="mt-2 nav-link mt-md-0 d-none d-lg-flex search">
                    <input type="text" class="form-control" placeholder="{{ __('message.search_products') }}">
                </form>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <!-- Language Switcher -->
            <li class="nav-item dropdown">
                @php
                    $currentLocale = app()->getLocale();
                    $targetLocale = $currentLocale == 'en' ? 'ar' : 'en';
                @endphp
                <a class="nav-link" href="{{ url('/language/' . $targetLocale) }}">
                    <i class="mdi mdi-translate"></i>
                    <span class="ms-1">{{ $currentLocale == 'en' ? 'العربية' : 'English' }}</span>
                </a>
            </li>

            <!-- Notifications -->
            <li class="nav-item dropdown border-left">
                <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                    <i class="mdi mdi-bell"></i>
                    @if(isset($notifications) && count($notifications) > 0)
                        <span class="count bg-danger"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <h6 class="p-3 mb-0">{{ __('message.notifications') }}</h6>
                    <div class="dropdown-divider"></div>
                    @forelse($notifications ?? [] as $notification)
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-calendar text-success"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1 preview-subject">{{ $notification->title ?? '' }}</p>
                                <p class="mb-0 text-muted ellipsis">{{ $notification->message ?? '' }}</p>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    @empty
                        <a class="dropdown-item preview-item">
                            <div class="preview-item-content">
                                <p class="mb-0 text-muted ellipsis">{{ __('message.no_notifications') }}</p>
                            </div>
                        </a>
                    @endforelse
                    <div class="dropdown-divider"></div>
                    <p class="p-3 mb-0 text-center">{{ __('message.see_all_notifications') }}</p>
                </div>
            </li>

            <!-- Profile -->
            <li class="nav-item dropdown">
                <a class="nav-link" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="navbar-profile">
                        <img class="img-xs rounded-circle" src="{{ asset('Admin/assets/images/faces/face15.jpg') }}" alt="">
                        <p class="mb-0 d-none d-sm-block navbar-profile-name">{{ Auth::user()->name }}</p>
                        <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                    <h6 class="p-3 mb-0">{{ __('message.profile') }}</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item preview-item" href="{{ route('admin.profile') }}">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-dark rounded-circle">
                                <i class="mdi mdi-settings text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="mb-1 preview-subject">{{ __('message.settings') }}</p>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}" id="logout-form" style="margin: 0; padding: 0;">
                        @csrf
                        <button type="submit" class="dropdown-item preview-item" style="border: none; width: 100%; background: none; cursor: pointer;">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-dark rounded-circle">
                                    <i class="mdi mdi-logout text-danger"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <p class="mb-1 preview-subject">Log out</p>
                            </div>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
        </button>
    </div>
</nav>

@if(session('success'))
    <div class="m-3 alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
function handleLogout(event) {
    event.preventDefault();
    const form = document.getElementById('logout-form');
    const logoutText = document.getElementById('logout-text');
    const button = event.currentTarget;
    
    // Disable the button and show loading state
    button.disabled = true;
    logoutText.textContent = 'Logging out...';
    
    fetch(form.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: new FormData(form),
        credentials: 'same-origin'
    }).then(response => {
        if (response.ok || response.redirected) {
            window.location.href = '{{ route("login") }}';
        } else {
            throw new Error('Logout failed');
        }
    }).catch(error => {
        console.error('Logout error:', error);
        // Reset button state
        button.disabled = false;
        logoutText.textContent = '{{ __("message.logout") }}';
        alert('Logout failed. Please try again.');
    });
}

// Add hover effect for the logout button
document.addEventListener('DOMContentLoaded', function() {
    const logoutButton = document.querySelector('#logout-form button');
    if (logoutButton) {
        logoutButton.addEventListener('mouseover', function() {
            this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
        });
        logoutButton.addEventListener('mouseout', function() {
            this.style.backgroundColor = '';
        });
    }
});
</script>
