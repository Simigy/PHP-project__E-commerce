<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{route('redirect')}}"><h2>Sixteen <em>Clothing</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="ml-auto navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('home')}}">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user-all-products')}}">
                <i class="fa fa-shopping-bag"></i> Our Products
              </a>
            </li>
            @auth
            <li class="nav-item">
              <a class="nav-link" href="{{route('user-showCart')}}">
                <i class="fa fa-shopping-cart"></i> Cart
                @if(session()->has('cart') && count(session('cart')) > 0)
                  <span class="badge badge-danger">{{ count(session('cart')) }}</span>
                @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('user-myWhishlist')}}">
                <i class="fa fa-heart"></i> Wishlist
                @if(session()->has('whishlist') && count(session('whishlist')) > 0)
                  <span class="badge badge-danger">{{ count(session('whishlist')) }}</span>
                @endif
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('user-orders') }}">
                <i class="fa fa-shopping-bag"></i> My Orders
              </a>
            </li>
            @endauth
            <li class="nav-item">
              <a class="nav-link" href="{{route('redirect')}}">
                <i class="fa fa-info-circle"></i> About Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('redirect')}}">
                <i class="fa fa-envelope"></i> Contact Us
              </a>
            </li>
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}" style="color: #fff; background-color: #007bff; border-radius: 4px; padding: 8px 15px; margin: 5px;">
                <i class="fa fa-sign-in"></i> Login
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}" style="color: #fff; background-color: #28a745; border-radius: 4px; padding: 8px 15px; margin: 5px;">
                <i class="fa fa-user-plus"></i> Register Now
              </a>
            </li>
            @else
            <li class="nav-item">
              <form action="{{ route('logout') }}" method="POST" class="d-inline" id="logout-form">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="bg-transparent border-0 nav-link" style="cursor: pointer; color: #ffffff; text-decoration: none; padding: 0.5rem 1rem;">
                  <i class="fa fa-sign-out"></i> Logout
                </button>
              </form>
            </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const logoutForm = document.getElementById('logout-form');
      if (logoutForm) {
        logoutForm.addEventListener('submit', function(e) {
          e.preventDefault();
          fetch(this.action, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
            },
            credentials: 'same-origin'
          }).then(response => {
            if (response.ok) {
              window.location.href = "{{ route('login') }}";
            }
          });
        });
      }
    });
  </script>