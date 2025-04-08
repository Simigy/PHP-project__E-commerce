@extends('admin.layouts.corona')

@section('title', __('message.products'))

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>{{ __('message.all_products') }}</h5>
                <a href="{{ route('admin-add-product') }}" class="btn btn-primary">
                    <i class="mdi mdi-plus"></i> {{ __('message.add_product') }}
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th>{{ __('message.id') }}</th>
                                <th>{{ __('message.name') }}</th>
                                <th>{{ __('message.price') }}</th>
                                <th>{{ __('message.stock') }}</th>
                                <th>{{ __('message.status') }}</th>
                                <th>{{ __('message.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products ?? [] as $product)
                            <tr>
                                <td>{{ optional($product)->id }}</td>
                                <td>{{ optional($product)->name }}</td>
                                <td>${{ number_format(optional($product)->price ?? 0, 2) }}</td>
                                <td>{{ optional($product)->stock }}</td>
                                <td>
                                    <span class="badge bg-{{ optional($product)->status == 'active' ? 'success' : 'danger' }}">
                                        {{ optional($product)->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin-edit-product', optional($product)->id) }}" class="btn btn-primary btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin-delete-product', optional($product)->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('{{ __('message.confirm_delete') }}')">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">{{ __('message.no_products') }}</td>
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