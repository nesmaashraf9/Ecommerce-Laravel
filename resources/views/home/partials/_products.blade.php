@if(isset($products) && $products->count() > 0)
 @foreach ($products as $product)
    <div class="col-md-3 col-sm-6 mb-4 d-flex">
        <div class="product-card w-100">
            <div class="product-img-container">
                <img class="product-img" src="{{ asset('product/' . $product->image) }}" alt="{{ $product->title }}">
            </div>
            <div class="product-body">
                <h5 class="product-title">{{ $product->title }}</h5>
                <div class="price-container">
                    @if ($product->discount_price)
                        <span class="original-price">${{ number_format($product->price, 2) }}</span>
                        <span class="current-price">${{ number_format($product->discount_price, 2) }}</span>
                    @else
                        <span class="current-price">${{ number_format($product->price, 2) }}</span>
                    @endif
                </div>
                <div class="product-actions mt-2">
                    <a href="{{ route('product.details', $product->id) }}" class="btn btn-outline-primary btn-sm w-100 mb-2">
                        <i class="fa fa-eye"></i> View Details
                    </a>
                    <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-add-to-cart">
                            <i class="fa fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
@else
    <div class="col-12">
        <div class="alert alert-info">No products found.</div>
    </div>
@endif

@if(isset($products) && method_exists($products, 'links'))
    <div class="col-12">
        <div class="d-flex justify-content-center mt-4">
            {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endif
