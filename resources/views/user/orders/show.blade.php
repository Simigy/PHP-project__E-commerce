@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Order Details #{{ $order->id }}</h2>
                    <a href="{{ route('user-orders') }}" class="btn btn-primary">
                        <i class="fa fa-arrow-left"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Order Information</h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'info') }}">
                                {{ ucfirst($order->status ?? 'pending') }}
                            </span>
                        </p>
                        <p><strong>Total Items:</strong> {{ $order->orderDetails->sum('quantity') }}</p>
                        <p><strong>Total Amount:</strong> ${{ number_format($order->orderDetails->sum(function($detail) { return $detail->price * $detail->quantity; }), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderDetails as $detail)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $detail->product->image) }}" alt="{{ $detail->product->name }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                                    <span>{{ $detail->product->name }}</span>
                                                </div>
                                            </td>
                                            <td>${{ number_format($detail->price, 2) }}</td>
                                            <td>{{ $detail->quantity }}</td>
                                            <td>${{ number_format($detail->price * $detail->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                        <td><strong>${{ number_format($order->orderDetails->sum(function($detail) { return $detail->price * $detail->quantity; }), 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
