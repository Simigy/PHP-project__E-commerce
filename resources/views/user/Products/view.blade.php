@extends('user.app.layout')

@section('content')
<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Product Details</h2>
                    <a href="{{ route('user-all-products') }}">view all products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-image">
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-details">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-price">
                        <h3>${{ $product->price }}</h3>
                    </div>
                    <div class="product-description">
                        <p>{{ $product->desc }}</p>
                    </div>
                    <div class="product-stock">
                        <span class="badge badge-{{ $product->quantity > 0 ? 'success' : 'danger' }}">
                            {{ $product->quantity > 0 ? 'In Stock: ' . $product->quantity : 'Out of Stock' }}
                        </span>
                    </div>
                    <div class="product-rating mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="stars me-3">
                                @php
                                    $rating = $product->reviews_avg_rating ?? 5;
                                    $fullStars = floor($rating);
                                    $halfStar = $rating - $fullStars >= 0.5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <i class="fa fa-star"></i>
                                    @elseif($i == $fullStars + 1 && $halfStar)
                                        <i class="fa fa-star-half-o"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                                <span class="rating-count ms-2">({{ $product->reviews_count ?? 0 }} reviews)</span>
                            </div>
                            <form action="{{ route('addToFavorite', $product->id) }}" method="POST" class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                @csrf
                                <button type="submit" class="btn {{ Auth::check() ? 'btn-danger' : 'btn-link p-0' }} favorite-btn {{ in_array($product->id, session('favorites', [])) ? 'active' : '' }}" id="favorite-btn-{{ $product->id }}">
                                    <i class="fa fa-heart {{ Auth::check() ? '' : 'fa-2x' }}"></i>
                                    @if(Auth::check())
                                        <span class="favorite-text">{{ in_array($product->id, session('favorites', [])) ? 'Remove from Favorites' : 'Add to Favorites' }}</span>
                                    @endif
                                </button>
                                <span class="favorite-count ms-2">{{ $product->favorites_count ?? 0 }} favorites</span>
                            </form>
                        </div>
                    </div>
                    
                    @if(Auth::check())
                        <div class="product-actions mt-4">
                            <div class="quantity-selector mb-3">
                                <label for="qty">Quantity:</label>
                                <select id="qty" class="form-control d-inline-block" style="width: 100px;">
                                    @for($i = 1; $i <= min(10, $product->quantity); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            
                            <form action="{{ route('user-addToCart', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="qty" id="qty-input" value="1">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                            </form>
                            
                            <form action="{{ route('user-addToWhishlist', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-bookmark"></i> Add to Wishlist
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .product-image-container {
        position: relative;
        overflow: hidden;
        height: 500px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
    }
    
    .product-image {
        width: 400px !important;
        height: 400px !important;
        object-fit: contain !important;
    }
    
    .product-details {
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .product-price {
        margin: 20px 0;
        color: #f33;
        font-size: 24px;
    }
    
    .product-description {
        margin: 20px 0;
        line-height: 1.6;
    }
    
    .product-stock {
        margin: 20px 0;
    }
    
    .favorite-btn {
        transition: all 0.3s ease !important;
        position: relative;
        outline: none !important;
    }

    .favorite-btn.active {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
        color: white !important;
    }

    .favorite-btn.active i {
        color: white !important;
    }

    .favorite-btn:not(.active) i {
        color: #dc3545;
    }

    .favorite-btn:not(.active):hover i {
        color: #28a745;
    }

    .favorite-btn.btn-link {
        border: none;
        background: none;
        padding: 0;
    }

    .favorite-btn.btn-link i {
        font-size: 24px;
        transition: all 0.3s ease;
    }

    .favorite-btn.btn-link:hover {
        transform: scale(1.1);
    }

    .favorite-btn:focus {
        box-shadow: none !important;
    }

    .favorite-count {
        font-size: 14px;
        color: #666;
        margin-left: 8px;
    }

    .stars {
        color: #ffc107;
    }

    .stars i {
        margin-right: 2px;
    }

    .rating-count {
        color: #666;
        font-size: 14px;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    // Update hidden input when quantity dropdown changes
    $('#qty').on('change', function() {
        var quantity = $(this).val();
        $('#qty-input').val(quantity);
    });
    
    // Handle favorite button click
    $('.favorite-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var button = form.find('.favorite-btn');
        var icon = button.find('i');
        var countSpan = form.find('.favorite-count');
        var textSpan = button.find('.favorite-text');
        
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                button.prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    button.toggleClass('active');
                    
                    if (button.hasClass('active')) {
                        if (button.hasClass('btn-danger')) {
                            button.removeClass('btn-danger').addClass('btn-success');
                        }
                        if (textSpan.length) {
                            textSpan.text('Remove from Favorites');
                        }
                    } else {
                        if (button.hasClass('btn-success')) {
                            button.removeClass('btn-success').addClass('btn-danger');
                        }
                        if (textSpan.length) {
                            textSpan.text('Add to Favorites');
                        }
                    }
                    
                    if (response.favorites_count !== undefined) {
                        countSpan.text(response.favorites_count + ' favorites');
                    }
                }
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    window.location.href = '{{ route("login") }}';
                } else {
                    alert('Error updating favorite status');
                }
            },
            complete: function() {
                button.prop('disabled', false);
            }
        });
    });
});
</script>
@endpush 