<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .auth-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .social-login {
            margin-top: 20px;
            text-align: center;
        }
        .google-btn {
            background-color: #fff;
            color: #757575;
            border: 1px solid #ddd;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .google-btn:hover {
            background-color: #f1f1f1;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h2>@yield('header')</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 