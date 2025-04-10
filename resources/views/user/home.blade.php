@extends('user.app.layout')

@section('content')
<div class="banner">
    <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
            <div class="text-content">
                <h4>Best Offer</h4>
                <h2>New Arrivals On Sale</h2>
            </div>
        </div>
        <div class="banner-item-02">
            <div class="text-content">
                <h4>Flash Deals</h4>
                <h2>Get your best products</h2>
            </div>
        </div>
        <div class="banner-item-03">
            <div class="text-content">
                <h4>Last Minute</h4>
                <h2>Grab last minute deals</h2>
            </div>
        </div>
    </div>
</div>

<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="/user/products">view all products <i class="fa fa-angle-right"></i></a>
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
                        <h6>${{ number_format($product->price, 2) }}</h6>
                        <p>{{ Str::limit($product->description, 100) }}</p>
                        <span>Stock: {{ $product->quantity }}</span>
                        <ul class="stars">
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <div class="product-actions mt-3">
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
                            
                            @auth
                            <form action="{{ route('addToFavorite', $product->id) }}" method="POST" class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm favorite-btn" id="favorite-btn-{{ $product->id }}">
                                    <i class="fa fa-heart favorite-icon"></i>
                                </button>
                            </form>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No products available at the moment.
                </div>
            </div>
            @endforelse
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
        width: 250px;
        height: 250px;
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
    
    .product-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
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
    
    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .favorite-btn.active .favorite-icon {
        color: #ff3366;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    console.log('Document ready');
    
    // Initialize owl carousel
    if($('.owl-banner').length) {
        console.log('Initializing owl carousel');
        $('.owl-banner').owlCarousel({
            items: 1,
            loop: true,
            nav: true,
            dots: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: {
                    nav: false
                },
                768: {
                    nav: true
                }
            }
        });
    }
    
    // Update hidden input when quantity dropdown changes
    $('select[id^="qty-"]').on('change', function() {
        console.log('Quantity changed');
        var productId = $(this).attr('id').split('-')[1];
        var quantity = $(this).val();
        $('#qty-input-' + productId).val(quantity);
    });
    
    // Handle favorite button click
    $('.favorite-btn').on('click', function(e) {
        console.log('Favorite button clicked');
        e.preventDefault();
        var button = $(this);
        var form = button.closest('form');
        var productId = form.data('product-id');
        
        // Toggle active class immediately for visual feedback
        button.toggleClass('active');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log('Success:', response);
                alert(response.message || 'Product added to favorites!');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Revert the button state if there was an error
                button.toggleClass('active');
                alert('An error occurred. Please try again.');
            }
        });
    });
    
    // Add hover effect for favorite buttons
    $('.favorite-btn').hover(
        function() {
            $(this).find('.favorite-icon').css('transform', 'scale(1.1)');
        },
        function() {
            if(!$(this).hasClass('active')) {
                $(this).find('.favorite-icon').css('transform', 'scale(1)');
            }
        }
    );
});
</script>
@endpush
