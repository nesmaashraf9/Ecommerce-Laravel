<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $product->description ?? '' }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" />
    <title>{{ $product->title }} - Product Details</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #ffffff);
            font-family: "Poppins", sans-serif;
        }

        .product_section {
            padding: 60px 0;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .product-container:hover {
            transform: translateY(-5px);
        }

        .product-image {
            flex: 1 1 50%;
            padding: 40px;
            background: linear-gradient(135deg, #ffffff, #f9f9f9);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 400px;
            position: relative;
            overflow: hidden;
        }

        .product-image img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            border-radius: 10px;
            transition: transform 0.4s ease;
            margin: 0 auto;
            display: block;
        }

        .product-image img:hover {
            transform: scale(1.05);
        }

        .product-info {
            flex: 1 1 50%;
            padding: 40px;
            color: #333;
        }

        .product-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .price-section {
            margin: 20px 0;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 700;
            color: #f7444e;
            margin-right: 10px;
        }

        .original-price {
            color: #888;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .discount-badge {
            background: #f7444e;
            color: #fff;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .product-description {
            margin: 25px 0;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .product-description h4 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 25px 0;
            flex-wrap: nowrap;
            width: 100%;
            max-width: 200px;
        }

        .quantity-btn {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            color: #333;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            padding: 0;
            flex-shrink: 0;
        }

        .quantity-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            background: #f8f9fa;
            color: #adb5bd;
            border-color: #dee2e6;
        }

        .quantity-btn:not(:disabled):hover {
            background: #f7444e;
            color: white;
            border-color: #f7444e;
            transform: translateY(-1px);
        }

        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            font-size: 16px;
            font-weight: 500;
            color: #333;
            -moz-appearance: textfield;
            padding: 0;
            margin: 0;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .quantity-input:focus {
            border-color: #f7444e;
            box-shadow: 0 0 0 0.2rem rgba(247, 68, 78, 0.25);
            outline: none;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .quantity-input:disabled {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }

        .btn-add-to-cart, .btn-buy-now {
            border: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            padding: 12px 25px;
            cursor: pointer;
        }

        .btn-add-to-cart {
            background: #f7444e;
            color: #fff;
        }

        .btn-add-to-cart:not(:disabled):hover {
            background: #e63a42;
            box-shadow: 0 5px 15px rgba(247,68,78,0.3);
        }

        .btn-add-to-cart:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .btn-buy-now {
            background: #2c3e50;
            color: #fff;
            margin-left: 10px;
        }

        .btn-buy-now:not(:disabled):hover {
            background: #1a252f;
        }

        .btn-buy-now:disabled {
            background: #6c757d;
            cursor: not-allowed;
            opacity: 0.7;
        }

        .product-meta {
            margin-top: 25px;
            font-size: 0.95rem;
        }

        .product-meta p {
            margin-bottom: 8px;
        }

        .in-stock {
            color: #28a745;
            font-weight: 600;
        }

        .out-of-stock {
            color: #dc3545;
            font-weight: 600;
        }

        .related-products {
            margin-top: 60px;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 30px;
            position: relative;
        }

        .section-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background: #f7444e;
        }

        .product-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s;
            margin-bottom: 20px;
            height: 100%;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card-img {
            padding: 15px;
            background: #f9f9f9;
        }

        .product-card-img img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .product-card-body {
            padding: 20px;
            text-align: center;
        }

        .product-card-price {
            font-weight: 700;
            color: #f7444e;
            margin: 10px 0;
        }

        .product-card-original-price {
            color: #888;
            text-decoration: line-through;
            font-size: 0.9em;
            margin-left: 5px;
        }

        .btn-view-details {
            display: inline-block;
            padding: 8px 20px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            color: #2c3e50;
            text-decoration: none;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .btn-view-details:hover {
            background: #f7444e;
            color: white;
            border-color: #f7444e;
            text-decoration: none;
        }

        .stock-status {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.9em;
            font-weight: 500;
        }

        @media (max-width: 992px) {
            .product-container {
                flex-direction: column;
            }
            .product-image, .product-info {
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    @include('home.header')

    <section class="product_section">
        <div class="container">
            <a href="{{ url()->previous() }}" class="btn btn-outline-dark mb-4">
                <i class="fa fa-arrow-left"></i> Back to Products
            </a>

            <div class="product-container">
                <div class="product-image">
                    <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->title }}">
                </div>
                <div class="product-info">
                    <h1 class="product-title">{{ $product->title }}</h1>

                    <div class="price-section">
                        @if($product->discount_price)
                            <span class="current-price">${{ number_format($product->discount_price, 2) }}</span>
                            <span class="original-price">${{ number_format($product->price, 2) }}</span>
                            <span class="discount-badge">Save ${{ number_format($product->price - $product->discount_price, 2) }}</span>
                        @else
                            <span class="current-price">${{ number_format($product->price, 2) }}</span>
                        @endif
                    </div>

                    <div class="product-description">
                        <h4>Description</h4>
                        <p>{{ $product->description ?? 'No description available.' }}</p>
                    </div>

                    @if(Auth::check())
                        @if($product->quantity > 0)
                            <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
                                @csrf
                                <div class="quantity-selector">
                                    <button type="button" class="quantity-btn" 
                                            onclick="decreaseQuantity()" 
                                            {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                        −
                                    </button>
                                    <input type="number" 
                                           name="quantity" 
                                           id="quantity" 
                                           class="quantity-input" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $product->quantity }}"
                                           {{ $product->quantity <= 0 ? 'disabled' : '' }}
                                           onkeydown="return event.keyCode !== 69 && event.keyCode !== 189">
                                    <button type="button" 
                                            class="quantity-btn" 
                                            onclick="increaseQuantity()" 
                                            {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                        +
                                    </button>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" 
                                            class="btn-add-to-cart" 
                                            {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                        <i class="fa fa-shopping-cart"></i> 
                                        {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                    </button>
                                    <a href="{{ $product->quantity > 0 ? '#' : 'javascript:void(0);' }}" 
                                       class="btn-buy-now" 
                                       {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                        <i class="fa fa-bolt"></i> Buy Now
                                    </a>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-danger">
                                <i class="fa fa-exclamation-circle"></i> This product is currently out of stock.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning mt-3">
                            <i class="fa fa-info-circle"></i> Please <a href="{{ route('login') }}">login</a> to add items to your cart.
                        </div>
                    @endif

                    <div class="product-meta mt-4">
                        <p><strong>Category:</strong> {{ $product->category_name ?? 'N/A' }}</p>
                        <p><strong>Availability:</strong>
                            @if($product->quantity > 0)
                                <span class="in-stock">
                                    <i class="fa fa-check-circle"></i> In Stock ({{ $product->quantity }} available)
                                </span>
                            @else
                                <span class="out-of-stock">
                                    <i class="fa fa-times-circle"></i> Out of Stock
                                </span>
                            @endif
                        </p>
                        <p><strong>SKU:</strong> {{ $product->id }}</p>
                    </div>
                </div>
            </div>

            @if(isset($relatedProducts) && $relatedProducts->count() > 0)
            <div class="related-products">
                <h3 class="section-title">You May Also Like</h3>
                <div class="row">
                    @foreach($relatedProducts as $related)
                    <div class="col-md-3 col-6 mb-4">
                        <div class="product-card h-100">
                            <div class="product-card-img">
                                <img src="{{ asset('product/'.$related->image) }}" alt="{{ $related->title }}" class="img-fluid">
                            </div>
                            <div class="product-card-body">
                                <h5>{{ $related->title }}</h5>
                                <div class="product-card-price">
                                    @if($related->discount_price)
                                        ${{ number_format($related->discount_price, 2) }}
                                        <span class="product-card-original-price">${{ number_format($related->price, 2) }}</span>
                                    @else
                                        ${{ number_format($related->price, 2) }}
                                    @endif
                                </div>
                                <div class="mt-2 mb-2">
                                    @if($related->quantity > 0)
                                        <span class="text-success small">
                                            <i class="fa fa-check-circle"></i> In Stock
                                        </span>
                                    @else
                                        <span class="text-danger small">
                                            <i class="fa fa-times-circle"></i> Out of Stock
                                        </span>
                                    @endif
                                </div>
                                <a href="{{ route('product.details', $related->id) }}" class="btn-view-details">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    @include('home.partials._reviews_section', [
        'reviews' => $product->reviews()->with('user')->latest()->paginate(5),
        'averageRating' => $product->averageRating(),
    ])

    @include('home.footer')

    <script>
    function updateQuantity(change) {
        const quantityInput = document.getElementById('quantity');
        const max = parseInt(quantityInput.getAttribute('max'));
        let currentValue = parseInt(quantityInput.value) || 1;
        let newValue = currentValue + change;
        
        // Ensure quantity is within bounds
        if (newValue < 1) newValue = 1;
        if (max && newValue > max) newValue = max;
        
        quantityInput.value = newValue;
        
        // Update button states
        const minusBtn = document.querySelector('.quantity-btn:first-of-type');
        const plusBtn = document.querySelector('.quantity-btn:last-of-type');
        
        minusBtn.disabled = newValue <= 1;
        plusBtn.disabled = max && newValue >= max;
    }

    function increaseQuantity() {
        updateQuantity(1);
    }

    function decreaseQuantity() {
        updateQuantity(-1);
    }

    // Handle direct input
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('quantity');
        if (quantityInput) {
            quantityInput.addEventListener('change', function() {
                let value = parseInt(this.value) || 1;
                const max = parseInt(this.getAttribute('max'));
                
                if (value < 1) value = 1;
                if (max && value > max) value = max;
                
                this.value = value;
                
                // Update button states
                const minusBtn = this.previousElementSibling;
                const plusBtn = this.nextElementSibling;
                
                if (minusBtn && plusBtn) {
                    minusBtn.disabled = value <= 1;
                    plusBtn.disabled = max && value >= max;
                }
            });
        }
    });
    </script>
</body>
</html>