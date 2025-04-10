@extends('layouts.auth')

@section('title', 'Login')
@section('header', 'Login to Your Account')

@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember" name="remember">
            <label class="form-check-label" for="remember">Remember Me</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

    <div class="social-login">
        <p class="text-center mb-3">Or login with</p>
        <a href="{{ route('auth.google') }}" class="google-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48">
                <path fill="#FFC107" d="M43.611 20.083H42V20H24v8h11.303c-1.649 4.657-6.08 8-11.303 8c-6.627 0-12-5.373-12-12s5.373-12 12-12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C12.955 4 4 12.955 4 24s8.955 20 20 20s20-8.955 20-20c0-1.341-.138-2.65-.389-3.917z"/>
                <path fill="#FF3D00" d="m6.306 14.691l6.571 4.819C14.655 15.108 18.961 12 24 12c3.059 0 5.842 1.154 7.961 3.039l5.657-5.657C34.046 6.053 29.268 4 24 4C16.318 4 9.656 8.337 6.306 14.691z"/>
                <path fill="#4CAF50" d="M24 44c5.166 0 9.86-1.977 13.409-5.192l-6.19-5.238A11.91 11.91 0 0 1 24 36c-5.202 0-9.619-3.317-11.283-7.946l-6.522 5.025C9.505 39.556 16.227 44 24 44z"/>
                <path fill="#1976D2" d="M43.611 20.083H42V20H24v8h11.303a12.04 12.04 0 0 1-4.087 5.571l.003-.002l6.19 5.238C36.971 39.205 44 34 44 24c0-1.341-.138-2.65-.389-3.917z"/>
            </svg>
            <span>Continue with Google</span>
        </a>
    </div>

    <div class="mt-4 text-center">
        <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
    </div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .card-body {
        padding: 30px;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .btn-primary {
        padding: 10px 20px;
    }
    
    .btn-link {
        color: #007bff;
        text-decoration: none;
    }
    
    .btn-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }
    
    .btn-success {
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .divider-text {
        position: relative;
        display: inline-block;
        padding: 0 10px;
        color: #6c757d;
        background: #fff;
    }

    .divider-text::before,
    .divider-text::after {
        content: '';
        position: absolute;
        top: 50%;
        width: 50px;
        height: 1px;
        background: #dee2e6;
    }

    .divider-text::before {
        right: 100%;
    }

    .divider-text::after {
        left: 100%;
    }

    .btn-google {
        background-color: #fff;
        color: #757575;
        border: 1px solid #ddd;
        padding: 10px 20px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-google:hover {
        background-color: #f8f9fa;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        color: #212529;
    }

    .btn-google i {
        font-size: 18px;
        color: #4285f4;
    }
</style>
@endpush

@push('scripts')
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
@endpush
