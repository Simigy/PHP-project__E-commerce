@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12">
                <h2>My Wishlist</h2>
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            @if (session()->has('whishlist') && count(session('whishlist')) > 0)
                @foreach ($whishlist as $id => $product)
                    <div class="col-md-4 mb-4">
                        <div class="product-item">
                            <div class="product-image-container">
                                <img src="{{ asset('storage/' . $product['image']) }}" alt="{{ $product['name'] }}" class="img-fluid product-image">
                                <div class="product-overlay">
                                    <div class="product-actions">
                                        <form action="{{ route('user-removeFromWhishlist', $id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="down-content">
                                <h4>{{ $product['name'] }}</h4>
                                <h6>${{ number_format($product['price'], 2) }}</h6>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <div class="alert alert-info">
                        Your wishlist is empty. <a href="{{ route('user-all-products') }}">Browse our products</a> to add items to your wishlist.
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 300px;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .product-image {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.5s ease;
    }
    
    .product-item:hover .product-image {
        transform: scale(1.1);
    }
    
    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .product-item:hover .product-overlay {
        opacity: 1;
    }
    
    .down-content {
        padding: 20px;
        background: #fff;
        border-radius: 0 0 8px 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .product-item {
        margin-bottom: 30px;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }
    
    .product-item:hover {
        transform: translateY(-5px);
    }
</style>
@endpush
