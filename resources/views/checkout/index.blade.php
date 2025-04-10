@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Checkout</h2>
                    <a href="{{ route('user-showCart') }}" class="btn btn-primary">Back to Cart <i class="fa fa-angle-left"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Shipping Information</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('checkout.process') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Shipping Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="postal_code" class="form-label">Postal Code</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Order Summary</h3>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $id => $details)
                            <div class="mb-2 d-flex justify-content-between">
                                <span>{{ $details['name'] }} x {{ $details['quantity'] }}</span>
                                <span>${{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .section-heading {
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .section-heading h2 {
        margin: 0;
    }
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
        padding: 15px 20px;
    }
    .card-header h3 {
        margin: 0;
        font-size: 18px;
        color: #333;
    }
    .card-body {
        padding: 20px;
    }
    .form-label {
        font-weight: 500;
        color: #555;
    }
    .btn-primary {
        padding: 10px 20px;
        font-weight: 500;
    }
</style>
@endpush