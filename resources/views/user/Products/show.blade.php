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
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-heart"></i> Add to Wishlist
                                </button>
                            </form>

                            @auth
                                <form action="{{ route('addToFavorite', $product->id) }}" method="POST"
                                    class="d-inline favorite-form" data-product-id="{{ $product->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger favorite-btn"
                                        id="favorite-btn-{{ $product->id }}">
                                        <i class="fa fa-heart favorite-icon"></i> Add to Favorites
                                    </button>
                                </form>
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

        .favorite-btn.active .favorite-icon {
            color: #28a745 !important;
        }

        .favorite-btn .favorite-icon {
            color: #dc3545;
            transition: color 0.3s ease;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            console.log('Document ready');

            // Update hidden input when quantity dropdown changes
            $('#qty').on('change', function() {
                var quantity = $(this).val();
                $('#qty-input').val(quantity);
            });

            // Handle favorite button click
            $('.favorite-form').on('submit', function(e) {
                e.preventDefault();
                console.log('Favorite form submitted');

                var form = $(this);
                var productId = form.data('product-id');
                var button = $('#favorite-btn-' + productId);
                var icon = button.find('.favorite-icon');

                console.log('Product ID:', productId);
                console.log('Button:', button);
                console.log('Icon:', icon);

                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log('Success response:', response);

                        // Toggle active class on button
                        button.toggleClass('active');

                        // Toggle icon color
                        if (button.hasClass('active')) {
                            icon.css('color', '#28a745');
                        } else {
                            icon.css('color', '#dc3545');
                        }

                        // Show success message
                        alert(response.message || 'Product added to favorites!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        console.error('Status:', status);
                        console.error('Response:', xhr.responseText);
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
