@extends('admin.layouts.corona')

@section('title', __('message.dashboard'))

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('message.total_products') }}</h5>
                <h2 class="mb-0">{{ $totalProducts ?? 0 }}</h2>
                <div class="mt-3">
                    <i class="mdi mdi-package-variant" style="font-size: 30px; color: #28a745;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('message.total_orders') }}</h5>
                <h2 class="mb-0">{{ $totalOrders ?? 0 }}</h2>
                <div class="mt-3">
                    <i class="mdi mdi-cart" style="font-size: 30px; color: #007bff;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('message.total_users') }}</h5>
                <h2 class="mb-0">{{ $totalUsers ?? 0 }}</h2>
                <div class="mt-3">
                    <i class="mdi mdi-account-group" style="font-size: 30px; color: #ffc107;"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ __('message.total_revenue') }}</h5>
                <h2 class="mb-0">${{ number_format($totalRevenue ?? 0, 2) }}</h2>
                <div class="mt-3">
                    <i class="mdi mdi-currency-usd" style="font-size: 30px; color: #28a745;"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5>{{ __('message.recent_orders') }}</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>{{ __('message.id') }}</th>
                                <th>{{ __('message.customer') }}</th>
                                <th>{{ __('message.amount') }}</th>
                                <th>{{ __('message.status') }}</th>
                                <th>{{ __('message.date') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                            <tr>
                                <td>{{ optional($order)->id }}</td>
                                <td>{{ optional(optional($order)->user)->name ?? __('message.guest') }}</td>
                                <td>${{ number_format(optional($order)->total_amount ?? 0, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ optional($order)->status == 'completed' ? 'success' : 'warning' }}">
                                        {{ optional($order)->status ?? 'pending' }}
                                    </span>
                                </td>
                                <td>{{ optional(optional($order)->created_at)->format('Y-m-d') ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">{{ __('message.no_recent_orders') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection