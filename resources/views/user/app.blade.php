<!DOCTYPE html>
<html lang="en">
@include('user.app.head')
<body>
    <!-- Header -->
    @include('user.app.header')

    <!-- Page Content -->
    @yield('content')

    <!-- Footer -->
    @include('user.app.footer')

    <!-- Scripts -->
    @include('user.app.scripts')
</body>
</html>