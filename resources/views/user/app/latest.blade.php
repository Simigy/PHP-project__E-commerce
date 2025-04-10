<div class="latest-products">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-heading">
                    <h2>Latest Products</h2>
                    <a href="{{route('user-all-products')}}">view all products <i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="product-item">
                        <a href="{{route('user-show-product', $product->id)}}"><img src="{{ asset("storage/$product->image") }}" alt=""></a>
                        @auth
                            <form action="{{ route('addToFavorite', $product->id) }}" method="post">
                                @csrf
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    @if ($product->isFavorites())
                                        <div class="fa fa-heart" style="color: red"></div>
                                    @else
                                        <div class="fa fa-heart" style="color: gray"></div>
                                    @endif
                                </button>
                            </form>
                        @endauth
                        <div class="down-content">
                            <a href="{{route('user-show-product', $product->id)}}">
                                <h4>{{ $product->name }}</h4>
                            </a>
                            <h6>${{ $product->price }}</h6>
                            <p>{{ $product->desc }}</p>
                            <span>Quantity: {{ $product->quantity }}</span>

                            @auth
                                <form action="{{ route('user-addToCart', $product->id) }}" method="POST">
                                    @csrf
                                    <input type="number" name="qty" min="1" max="{{ $product->quantity }}" value="1" class="form-control mb-2">
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </form>
                            @endauth
                            <form action="{{ route('user-addToWhishlist', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Add to wishlist</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
