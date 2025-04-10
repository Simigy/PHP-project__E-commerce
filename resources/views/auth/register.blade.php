@extends('layouts.auth')

@section('title', 'Register')
@section('header', 'Create an Account')

@section('content')
    <form method="POST" action="{{ route('register') }}" id="registerForm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
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

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary" id="registerButton">Register</button>
        </div>
    </form>

    <div class="social-login">
        <p class="text-center mb-3">Or register with</p>
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
        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
@endsection

@push('scripts')
<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const button = document.getElementById('registerButton');
    button.disabled = true;
    button.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Registering...';

    // Get form data
    const formData = new FormData(this);

    // Submit the form
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        credentials: 'same-origin'
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        return response.json();
    })
    .then(data => {
        if (data && data.errors) {
            // Handle validation errors
            Object.keys(data.errors).forEach(field => {
                const input = document.querySelector(`[name="${field}"]`);
                if (input) {
                    input.classList.add('is-invalid');
                    const feedback = input.nextElementSibling;
                    if (feedback && feedback.classList.contains('invalid-feedback')) {
                        feedback.textContent = data.errors[field][0];
                    }
                }
            });
            button.disabled = false;
            button.innerHTML = 'Register';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        button.disabled = false;
        button.innerHTML = 'Register';
        alert('Registration failed. Please try again.');
    });
});
</script>
@endpush
