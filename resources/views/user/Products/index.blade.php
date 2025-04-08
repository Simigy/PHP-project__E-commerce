@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>All Products</h2>
                </div>
            </div>
            @forelse($products as $product)
                <div class="col-md-4">
                    <div class="product-item">
                        <div class="product-image-container">
                            <a href="{{ route('user-show-product', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                            </a>
                            <div class="product-overlay">
                                <div class="product-actions">
                                    <a href="{{ route('user-show-product', $product->id) }}" class="btn btn-sm btn-info">
                                        <i class="fa fa-eye"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="down-content">
                            <a href="{{ route('user-show-product', $product->id) }}">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <h6>${{ $product->price }}</h6>
                            <p>{{ Str::limit($product->desc, 100) }}</p>
                            <div class="product-meta">
                                <span class="stock-info">Stock: {{ $product->quantity }}</span>
                                <ul class="stars">
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                    <li><i class="fa fa-star"></i></li>
                                </ul>
                            </div>
                            <div class="product-actions mt-3">
                                @auth
                                    <div class="quantity-selector mb-2">
                                        <label for="qty-{{ $product->id }}">Quantity:</label>
                                        <select id="qty-{{ $product->id }}" class="form-control form-control-sm d-inline-block" style="width: 70px;">
                                            @for($i = 1; $i <= min(10, $product->quantity); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                    <form action="{{ route('user-addToCart', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="qty" id="qty-input-{{ $product->id }}" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            <i class="fa fa-shopping-cart"></i> Add to Cart
                                        </button>
                                    </form>

                                    <form action="{{ route('user-addToWhishlist', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-info btn-sm">
                                            <i class="fa fa-heart"></i> Add to Wishlist
                                        </button>
                                    </form>

                                    <form action="{{ route('addToFavorite', $product->id) }}" method="POST" class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm favorite-btn {{ in_array($product->id, $favorites ?? []) ? 'active' : '' }}" id="favorite-btn-{{ $product->id }}">
                                            <i class="fa fa-heart favorite-icon" style="color: {{ in_array($product->id, $favorites ?? []) ? '#28a745' : '#dc3545' }};"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('addToFavorite', $product->id) }}" method="POST" class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm favorite-btn" id="favorite-btn-{{ $product->id }}">
                                            <i class="fa fa-heart favorite-icon" style="color: #dc3545;"></i>
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">No products found.</div>
                </div>
            @endforelse
        </div>

        <div class="row">
            <div class="col-md-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .product-item {
        margin-bottom: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-5px);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px 8px 0 0;
    }

    .product-image {
        width: 100%;
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .product-item:hover .product-image {
        transform: scale(1.05);
    }

    .product-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
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
    }

    .down-content h4 {
        margin: 0 0 10px;
        font-size: 18px;
        color: #1E1E1E;
    }

    .down-content h6 {
        color: #f33;
        font-size: 20px;
        margin-bottom: 10px;
    }

    .down-content p {
        color: #777;
        margin-bottom: 15px;
        line-height: 1.6;
    }

    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
    }

    .stock-info {
        color: #666;
        font-size: 14px;
    }

    .stars {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .stars li {
        margin-right: 2px;
        color: #ffc107;
    }

    .product-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .favorite-btn {
        transition: all 0.3s ease;
        border: none;
        background: transparent;
    }

    .favorite-btn .favorite-icon {
        transition: color 0.3s ease;
    }

    .favorite-btn:hover .favorite-icon {
        transform: scale(1.2);
    }

    .favorite-btn.active {
        background: transparent;
    }

    .favorite-btn.active .favorite-icon {
        color: #28a745 !important;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Update hidden input when quantity dropdown changes
    $('select[id^="qty-"]').on('change', function() {
        var productId = $(this).attr('id').split('-')[1];
        var quantity = $(this).val();
        $('#qty-input-' + productId).val(quantity);
    });

    // Handle favorite button click
    $('.favorite-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var productId = form.data('product-id');
        var button = $('#favorite-btn-' + productId);
        var icon = button.find('.favorite-icon');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                button.toggleClass('active');
                if (button.hasClass('active')) {
                    icon.css('color', '#28a745');
                } else {
                    icon.css('color', '#dc3545');
                }
                toastr.success(response.message || 'Favorite status updated!');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                toastr.error('An error occurred. Please try again.');
            }
        });
    });
});
</script>
@endpush
