@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Order Confirmation</h2>
                    <a href="{{ route('user-all-products') }}" class="btn btn-primary">Continue Shopping <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="text-center card-body">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        <h2 class="mt-3">Order Placed Successfully!</h2>
                        <p class="lead">Thank you for your order. Your order number is #{{ $order->id }}</p>
                        <p>We will process your order soon. You can track your order status in your order history.</p>
                        
                        <div class="mt-4">
                            <h4>Order Details</h4>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <table class="table">
                                        <tr>
                                            <th>Order Total:</th>
                                            <td>${{ number_format($order->total_amount, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping Address:</th>
                                            <td>{{ $order->shipping_address }}, {{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contact Phone:</th>
                                            <td>{{ $order->shipping_phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status:</th>
                                            <td><span class="badge bg-info">{{ ucfirst($order->status) }}</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('user-orders') }}" class="btn btn-primary">View My Orders</a>
                            <a href="{{ route('user-all-products') }}" class="btn btn-outline-primary">Continue Shopping</a>
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
    .card-body {
        padding: 30px;
    }
    .table {
        margin-top: 20px;
    }
    .table th {
        width: 35%;
        color: #555;
    }
    .badge {
        padding: 8px 12px;
        font-size: 14px;
    }
    .btn {
        margin: 0 5px;
        padding: 10px 20px;
        font-weight: 500;
    }
</style>
@endpush