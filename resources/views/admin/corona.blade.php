@extends('admin.layouts.corona')

@section('title', 'Corona Admin Dashboard')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card corona-gradient-card">
            <div class="card-body py-0 px-0 px-sm-3">
                <div class="row align-items-center">
                    <div class="col-4 col-sm-3 col-xl-2">
                        <img src="{{ asset('Admin/assets/images/dashboard/Group126@2x.png') }}" class="gradient-corona-img img-fluid" alt="">
                    </div>
                    <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Welcome to Corona Admin Dashboard</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">Your e-commerce statistics at a glance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $totalProducts }}</h3>
                            <p class="text-success ms-2 mb-0 font-weight-medium">+{{ number_format($productGrowth, 1) }}%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-package-variant icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Products</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $totalOrders }}</h3>
                            <p class="text-success ms-2 mb-0 font-weight-medium">+{{ number_format($orderGrowth, 1) }}%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-cart icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Orders</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">{{ $totalUsers }}</h3>
                            <p class="text-success ms-2 mb-0 font-weight-medium">+{{ number_format($userGrowth, 1) }}%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-account-multiple icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Users</h6>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                            <h3 class="mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                            <p class="text-success ms-2 mb-0 font-weight-medium">+{{ number_format($revenueGrowth, 1) }}%</p>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="icon icon-box-success">
                            <span class="mdi mdi-currency-usd icon-item"></span>
                        </div>
                    </div>
                </div>
                <h6 class="text-muted font-weight-normal">Total Revenue</h6>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Recent Orders</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>${{ number_format($order->total_amount, 2) }}</td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Low Stock Products</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lowStockProducts as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <div class="badge badge-danger">{{ $product->quantity }}</div>
                                </td>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.icon-box-success {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.icon-item {
    font-size: 24px;
}

.gradient-corona-img {
    max-width: 100%;
    height: auto;
}

.text-success {
    color: #28a745 !important;
}

.badge {
    padding: 0.4em 0.8em;
}

.table td {
    vertical-align: middle;
}
</style>
@endpush
