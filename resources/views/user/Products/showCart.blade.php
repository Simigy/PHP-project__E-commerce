@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Your Shopping Cart</h2>
                    <a href="{{route('user-all-products')}}" class="btn btn-primary">Continue Shopping <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(!$cart || count($cart) === 0)
            <div class="row">
                <div class="text-center col-md-12">
                    <h3>Your cart is empty</h3>
                    <a href="{{route('user-all-products')}}" class="mt-3 btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0; @endphp
                                @foreach ($cart as $id => $product)
                                    @php $itemTotal = $product['price'] * $product['quantity']; $total += $itemTotal; @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                <span>{{ $product['name'] }}</span>
                                            </div>
                                        </td>
                                        <td>${{ $product['price'] }}</td>
                                        <td>
                                            <form action="{{ route('user-addToCart', $id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="number" name="qty" value="{{ $product['quantity'] }}" min="1" max="100" class="form-control form-control-sm" style="width: 70px;">
                                                <button type="submit" class="mt-1 btn btn-sm btn-info">Update</button>
                                            </form>
                                        </td>
                                        <td>${{ number_format($itemTotal, 2) }}</td>
                                        <td>
                                            <form action="{{ route('user-removeFromCart', $id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                    <td colspan="2"><strong>${{ number_format($total, 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-3">
                        <form action="{{ route('user-clearCart') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-secondary">Clear Cart</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="mb-2 d-flex justify-content-between">
                                <span>Subtotal:</span>
                                <span>${{ number_format($total, 2) }}</span>
                            </div>
                            <div class="mb-2 d-flex justify-content-between">
                                <span>Shipping:</span>
                                <span>Free</span>
                            </div>
                            <hr>
                            <div class="mb-3 d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong>${{ number_format($total, 2) }}</strong>
                            </div>

                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .section-heading {
        margin-bottom: 30px;
    }
    .section-heading .btn {
        margin-left: 15px;
    }
    .table img {
        border-radius: 4px;
    }
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #eee;
    }
</style>
@endpush
