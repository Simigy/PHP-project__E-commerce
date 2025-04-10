@extends('user.app.layout')

@section('content')
    <div class="latest-products">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-heading">
                        <h2>Product Details</h2>
                        <a href="/user/products">view all products <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-image-container">
                        <img src="{{ asset("storage/$product->image") }}" alt="{{ $product->name }}" class="product-image">
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
                            <span class="badge badge-success">In Stock: {{ $product->quantity }}</span>
                        </div>
                        <div class="product-rating">
                            <ul class="stars">
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                                <li><i class="fa fa-star"></i></li>
                            </ul>
                        </div>
                        <div class="mt-4 product-actions">
                            <div class="mb-3 quantity-selector">
                                <label for="qty">Quantity:</label>
                                <select id="qty" class="form-control d-inline-block" style="width: 100px;">
                                    @for ($i = 1; $i <= min(10, $product->quantity); $i++)
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
                                <button type="submit" class="btn {{ isset(session('whishlist')[$product->id]) ? 'btn-danger' : 'btn-info' }}">
                                    <i class="fa fa-heart"></i> 
                                    {{ isset(session('whishlist')[$product->id]) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                                </button>
                            </form>

                            @auth
                                <form action="{{ route('addToFavorite', $product->id) }}" method="POST"
                                    class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                    @csrf
                                    <button type="submit" 
                                        class="btn btn-outline-danger favorite-btn {{ in_array($product->id, $favorites ?? []) ? 'active' : '' }}"
                                        id="favorite-btn-{{ $product->id }}">
                                        <i class="fa fa-heart favorite-icon" 
                                           style="color: {{ in_array($product->id, $favorites ?? []) ? '#28a745' : '#dc3545' }};">
                                        </i> 
                                        <span class="favorite-text">
                                            {{ in_array($product->id, $favorites ?? []) ? 'Remove from Favorites' : 'Add to Favorites' }}
                                        </span>
                                    </button>
                                </form>
                            @else
                                <button type="button" class="btn btn-outline-danger guest-favorite-btn">
                                    <i class="fa fa-heart" style="color: #dc3545;"></i> 
                                    <span class="favorite-text">Add to Favorites</span>
                                </button>
                            @endauth
                        </div>
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
            width: 400px;
            height: 400px;
            object-fit: contain;
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

        .product-rating {
            margin: 20px 0;
        }

        .stars {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .stars li {
            margin-right: 5px;
            color: #ffc107;
        }

        .product-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .favorite-btn {
            transition: all 0.3s ease;
            border: 1px solid #dc3545;
            background: transparent;
            color: #dc3545;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        .favorite-btn:hover {
            background: #dc3545;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
        }

        .favorite-btn:hover .favorite-icon {
            color: white !important;
            transform: scale(1.1);
        }

        .favorite-btn.active {
            border-color: #28a745;
            background: #28a745;
            color: white;
        }

        .favorite-btn.active .favorite-icon {
            color: white !important;
        }

        .favorite-btn.active:hover {
            background: #dc3545;
            border-color: #dc3545;
        }

        .favorite-icon {
            transition: all 0.3s ease;
            display: inline-block;
            margin-right: 5px;
        }

        .favorite-text {
            display: inline-block;
            vertical-align: middle;
        }

        .guest-favorite-btn {
            transition: all 0.3s ease;
            border: 1px solid #dc3545;
            background: transparent;
            color: #dc3545;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            outline: none;
        }

        .guest-favorite-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(220, 53, 69, 0.2);
        }

        .guest-favorite-btn.active {
            background: #28a745;
            border-color: #28a745;
            color: white;
        }

        .guest-favorite-btn.active i {
            color: white !important;
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
                var productId = form.data('product-id');
                var button = $('#favorite-btn-' + productId);
                var icon = button.find('.favorite-icon');
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
                        button.css('opacity', '0.7');
                    },
                    success: function(response) {
                        if (response.success) {
                            // Toggle active class
                            button.toggleClass('active');
                            
                            if (response.status) { // Added to favorites
                                button.css('background-color', '#28a745');
                                button.css('border-color', '#28a745');
                                icon.css('color', 'white');
                                textSpan.text('Remove from Favorites');
                                
                                // Add animation
                                icon.css('transform', 'scale(1.3)');
                                setTimeout(() => {
                                    icon.css('transform', 'scale(1)');
                                }, 200);
                            } else { // Removed from favorites
                                button.css('background-color', 'transparent');
                                button.css('border-color', '#dc3545');
                                icon.css('color', '#dc3545');
                                textSpan.text('Add to Favorites');
                                
                                // Add animation
                                icon.css('transform', 'scale(0.8)');
                                setTimeout(() => {
                                    icon.css('transform', 'scale(1)');
                                }, 200);
                            }
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            window.location.href = "{{ route('login') }}";
                        }
                    },
                    complete: function() {
                        button.prop('disabled', false);
                        button.css('opacity', '1');
                    }
                });
            });

            // Handle guest favorite button click
            $(document).on('click', '.guest-favorite-btn', function() {
                var button = $(this);
                var icon = button.find('i');
                var text = button.find('.favorite-text');
                
                if (!button.hasClass('active')) {
                    icon.css('color', '#28a745');
                    button.css('background-color', '#28a745');
                    button.css('border-color', '#28a745');
                    button.addClass('active');
                    text.text('Remove from Favorites');
                    icon.css('transform', 'scale(1.2)');
                    setTimeout(() => {
                        icon.css('transform', 'scale(1)');
                    }, 200);
                } else {
                    icon.css('color', '#dc3545');
                    button.css('background-color', 'transparent');
                    button.css('border-color', '#dc3545');
                    button.removeClass('active');
                    text.text('Add to Favorites');
                    icon.css('transform', 'scale(0.8)');
                    setTimeout(() => {
                        icon.css('transform', 'scale(1)');
                    }, 200);
                }
            });
        });
    </script>
@endpush
