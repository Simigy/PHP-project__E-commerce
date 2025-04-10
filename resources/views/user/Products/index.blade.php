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
                            <p>{{ Str::limit($product->description, 100) }}</p>
                            <div class="product-meta">
                                <span class="stock-info badge badge-{{ $product->quantity > 0 ? 'success' : 'danger' }}">
                                    {{ $product->quantity > 0 ? 'In Stock: ' . $product->quantity : 'Out of Stock' }}
                                </span>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="stars">
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
                                        <span class="rating-count ms-2">({{ $product->reviews_count ?? 0 }})</span>
                                    </div>
                                    @guest
                                    <button 
                                        type="button" 
                                        class="heart-btn btn btn-link p-0" 
                                        style="position:relative; z-index:10; background-color:rgba(255,255,255,0.9); border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 5px rgba(0,0,0,0.2); border:none; outline:none; cursor:pointer; transition:all 0.3s ease; margin-right:0; padding:10px;"
                                        onclick="var heart = this.querySelector('i'); if (heart.getAttribute('data-active') === 'true') { heart.style.color = '#dc3545'; heart.setAttribute('data-active', 'false'); } else { heart.style.color = '#28a745'; heart.setAttribute('data-active', 'true'); }"
                                    >
                                        <i class="fa fa-heart fa-lg" style="color:#dc3545; font-size:22px; transition:all 0.3s ease;" data-active="false"></i>
                                    </button>
                                    @endguest
                                </div>
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

                                    <div class="button-group">
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
                                                <i class="fa fa-bookmark"></i> Add to Wishlist
                                            </button>
                                        </form>

                                        <form action="{{ route('user-toggleFavorite', $product->id) }}" method="POST" class="d-inline favorite-form">
                                            @csrf
                                            <button type="button" 
                                                class="heart-btn btn btn-link p-0" 
                                                style="position:relative; z-index:10; background-color:rgba(255,255,255,0.9); border-radius:50%; width:40px; height:40px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 5px rgba(0,0,0,0.2); border:none; outline:none; cursor:pointer; transition:all 0.3s ease; margin:0 0 0 5px; padding:10px;"
                                                onclick="var heart = this.querySelector('i'); var form = this.closest('form'); if (heart.getAttribute('data-active') === 'true') { heart.style.color = '#dc3545'; heart.setAttribute('data-active', 'false'); this.setAttribute('data-active', 'false'); } else { heart.style.color = '#28a745'; heart.setAttribute('data-active', 'true'); this.setAttribute('data-active', 'true'); }; this.classList.add('animated'); setTimeout(function(btn) { btn.classList.remove('animated'); }, 300, this); fetch(form.action, {method: 'POST', headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-CSRF-TOKEN': form.querySelector('input[name=_token]').value}, body: new URLSearchParams(new FormData(form))});"
                                                data-active="{{ in_array($product->id, $favorites) ? 'true' : 'false' }}">
                                                <i class="fa fa-heart fa-lg" style="color: {{ in_array($product->id, $favorites) ? '#28a745' : '#dc3545' }}; font-size:22px; transition:all 0.3s ease;" data-active="{{ in_array($product->id, $favorites) ? 'true' : 'false' }}"></i>
                                            </button>
                                        </form>
                                    </div>
                                
                                    <style>
                                    .button-group {
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                        flex-wrap: wrap;
                                    }
                                    
                                    .button-group form:nth-child(1),
                                    .button-group form:nth-child(2) {
                                        flex: 1;
                                        margin-right: 5px;
                                    }
                                    
                                    .button-group .favorite-form {
                                        flex: 0 0 auto;
                                    }
                                    </style>
                                @else
                                    <div class="button-group">
                                        <!-- Guest favorite button moved to its own container at bottom of card -->
                                    </div>
                                @endauth
                            </div>
                            @guest
                            <!-- Removed the container at the bottom as the heart is now with the stars -->
                            @endguest
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
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-item:hover {
        transform: translateY(-5px);
    }

    .product-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 8px 8px 0 0;
        height: 250px;
    }

    .product-image {
        width: 100%;
        height: 100%;
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
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .down-content h4 {
        margin: 0 0 10px;
        font-size: 18px;
        color: #1E1E1E;
        font-weight: 600;
    }

    .down-content h6 {
        color: #f33f3f;
        font-size: 22px;
        margin-bottom: 15px;
        font-weight: bold;
    }

    .down-content p {
        color: #777;
        margin-bottom: 15px;
        line-height: 1.6;
        font-size: 14px;
        flex-grow: 1;
    }

    .product-meta {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin: 15px 0;
        padding: 10px 0;
        border-top: 1px solid #eee;
        border-bottom: 1px solid #eee;
    }

    .stock-info {
        color: #666;
        font-size: 14px;
        font-weight: 500;
    }

    .stars {
        display: flex;
        align-items: center;
    }

    .stars i {
        color: #ffc107;
        font-size: 14px;
        margin-right: 2px;
    }

    .favorite-form {
        margin: 0;
    }

    .favorite-btn, .guest-favorite-btn {
        border: none !important;
        background: none !important;
        cursor: pointer !important;
        outline: none !important;
        box-shadow: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.3s ease !important;
        margin: 0 !important;
        padding: 0 !important;
        height: 35px !important;
        width: 35px !important;
        position: relative !important;
        z-index: 1 !important;
    }

    .favorite-btn:hover, .guest-favorite-btn:hover {
        transform: scale(1.1) !important;
    }

    .favorite-btn:focus, .guest-favorite-btn:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .favorite-btn .fa-heart, .guest-favorite-btn .fa-heart {
        transition: all 0.3s ease !important;
        font-size: 20px !important;
    }

    .favorite-btn.active .fa-heart {
        color: #28a745 !important;
    }

    .product-actions {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
        margin-top: 15px;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        justify-content: center;
    }

    .quantity-selector label {
        font-size: 14px;
        color: #666;
        margin-bottom: 0;
    }

    .btn-sm {
        padding: 8px 15px;
        font-size: 14px;
        font-weight: 500;
        width: 100%;
        text-align: center;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        border-radius: 4px;
    }

    .form-control-sm {
        height: 35px;
        padding: 5px 10px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }

    .product-actions form {
        width: 100%;
    }

    .btn-primary {
        background: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background: #0056b3;
        border-color: #0056b3;
    }

    .btn-info {
        background: #17a2b8;
        border-color: #17a2b8;
    }

    .btn-info:hover {
        background: #138496;
        border-color: #138496;
    }

    .text-success {
        color: #28a745 !important;
    }

    .fa-heart {
        cursor: pointer !important;
        transition: all 0.3s ease !important;
    }

    .fa-heart:hover {
        transform: scale(1.1);
    }

    .favorite-btn.active {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
        color: white !important;
    }

    .button-group {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }

    .button-group form {
        margin: 0;
    }

    .guest-favorite-btn {
        position: relative !important;
        z-index: 10 !important;
        background-color: rgba(255, 255, 255, 0.9) !important;
        border-radius: 50% !important;
        width: 40px !important;
        height: 40px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2) !important;
        border: none !important;
        outline: none !important;
        cursor: pointer !important;
        transition: all 0.3s ease !important;
        margin-right: 0 !important;
        padding: 10px !important;
    }

    .guest-favorite-btn:hover {
        transform: scale(1.1) !important;
        box-shadow: 0 4px 8px rgba(0,0,0,0.3) !important;
    }

    .guest-favorite-btn .fa-heart {
        font-size: 22px !important;
        transition: all 0.3s ease !important;
        -webkit-filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.3));
        filter: drop-shadow(1px 1px 1px rgba(0,0,0,0.3));
    }

    .guest-favorite-btn .fa-heart.active {
        color: #28a745 !important;
    }

    @keyframes heart-pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .animated {
        animation: heart-pulse 0.3s ease-in-out;
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
});

// Function for authenticated users with improved toggling
function toggleAuthFavorite(btn) {
    var heart = $(btn).find('.fa-heart');
    var form = $(btn).closest('form');
    var isActive = $(btn).attr('data-active') === 'true';
    
    // Toggle the state and update the UI immediately
    if (isActive) {
        heart.css('color', '#dc3545'); // Change to red
        $(btn).attr('data-active', 'false');
        heart.attr('data-active', 'false');
    } else {
        heart.css('color', '#28a745'); // Change to green
        $(btn).attr('data-active', 'true');
        heart.attr('data-active', 'true');
    }
    
    // Visual feedback
    $(btn).css('transform', 'scale(1.2)');
    setTimeout(function() {
        $(btn).css('transform', '');
    }, 200);
    
    // Send AJAX request
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: form.serialize(),
        success: function(response) {
            if (response.success) {
                if (response.is_favorited) {
                    heart.css('color', '#28a745');
                    $(btn).addClass('active');
                    $(btn).attr('data-active', 'true');
                    heart.attr('data-active', 'true');
                } else {
                    heart.css('color', '#dc3545');
                    $(btn).removeClass('active');
                    $(btn).attr('data-active', 'false');
                    heart.attr('data-active', 'false');
                }
            }
        },
        error: function() {
            // If error, revert to the opposite state
            if (isActive) {
                heart.css('color', '#28a745');
                $(btn).attr('data-active', 'true');
                heart.attr('data-active', 'true');
            } else {
                heart.css('color', '#dc3545');
                $(btn).attr('data-active', 'false');
                heart.attr('data-active', 'false');
            }
        }
    });
}
</script>
@endpush
