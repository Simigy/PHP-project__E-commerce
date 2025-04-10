<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}"><h2>Sixteen <em>Clothing</em></h2></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="ml-auto navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">Home
                            @if(request()->routeIs('home'))
                                <span class="sr-only">(current)</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user-all-products') ? 'active' : '' }}" href="{{route('user-all-products')}}">
                            <i class="fa fa-shopping-bag"></i> Our Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative {{ request()->routeIs('user-showCart') ? 'active' : '' }}" href="{{ auth()->check() ? route('user-showCart') : route('login') }}">
                            <i class="fa fa-shopping-cart"></i> Cart
                            @auth
                                @if(session()->has('cart') && count(session('cart')) > 0)
                                    <span class="badge badge-pill badge-danger cart-badge">{{ count(session('cart')) }}</span>
                                @endif
                            @endauth
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link position-relative {{ request()->routeIs('user-myWhishlist') ? 'active' : '' }}" href="{{ auth()->check() ? route('user-myWhishlist') : route('login') }}">
                            <i class="fa fa-heart"></i> Wishlist
                            @auth
                                @if(session()->has('whishlist') && count(session('whishlist')) > 0)
                                    <span class="badge badge-pill badge-danger wishlist-badge">{{ count(session('whishlist')) }}</span>
                                @endif
                            @endauth
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user-orders') ? 'active' : '' }}" href="{{ route('user-orders') }}">
                            <i class="fa fa-shopping-bag"></i> My Orders
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="fa fa-info-circle"></i> About Us
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="fa fa-envelope"></i> Contact Us
                        </a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link login-btn" href="{{ route('login') }}">
                            <i class="fa fa-sign-in"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link register-btn" href="{{ route('register') }}">
                            <i class="fa fa-user-plus"></i> Register Now
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link logout-btn" id="logout-btn" style="background: none; border: none; cursor: pointer; width: 100%; text-align: left;">
                                <i class="fa fa-sign-out"></i> <span class="logout-text">Logout</span>
                            </button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>

<style>
.navbar {
    background: #232323;
    padding: 20px 0;
    border: none;
    margin-bottom: 0;
}

.navbar .navbar-brand {
    text-decoration: none;
}

.navbar .nav-link {
    text-decoration: none;
    padding: 8px 15px;
    color: #fff;
    transition: all 0.3s;
    position: relative;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #f33f3f;
    background: transparent;
}

.navbar .nav-link::after {
    display: none;
}

.position-relative {
    position: relative !important;
}

.cart-badge,
.wishlist-badge {
    position: absolute;
    top: -5px;
    right: 0;
    font-size: 10px;
    padding: 3px 6px;
    border-radius: 50%;
    min-width: 18px;
    height: 18px;
    line-height: 12px;
    text-align: center;
    background-color: #dc3545;
    color: white;
    font-weight: bold;
}

.login-btn,
.register-btn {
    color: #fff !important;
    border-radius: 4px;
    padding: 8px 15px;
    margin: 5px;
    text-decoration: none;
}

.login-btn {
    background-color: #007bff;
}

.register-btn {
    background-color: #28a745;
}

.logout-btn {
    color: #ffffff;
    text-decoration: none;
    padding: 8px 15px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.logout-btn:hover {
    color: #f33f3f;
}

.logout-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const logoutForm = document.getElementById('logout-form');
    const logoutBtn = document.getElementById('logout-btn');
    const logoutText = logoutBtn.querySelector('.logout-text');
    
    if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable button and show loading state
            logoutBtn.disabled = true;
            logoutText.textContent = 'Logging out...';
            
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                credentials: 'same-origin'
            }).then(response => {
                if (response.ok || response.redirected) {
                    window.location.href = '/';
                } else {
                    throw new Error('Logout failed');
                }
            }).catch(error => {
                console.error('Logout error:', error);
                // Reset button state
                logoutBtn.disabled = false;
                logoutText.textContent = 'Logout';
                alert('Logout failed. Please try again.');
            });
        });
    }
});
</script>