<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="{{ $product->description ?? '' }}" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="">
    <title>{{ $product->title }} - Product Details</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        .product-details-section {
            padding: 40px 0;
            min-height: 100vh;
        }
        
        .product-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        
        .product-image {
            padding: 20px;
            text-align: center;
            background: #fff;
            border-right: 1px solid #eee;
        }
        
        .product-image img {
            max-height: 500px;
            width: 100%;
            object-fit: contain;
        }
        
        .product-info {
            padding: 30px;
        }
        
        .product-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .price-section {
            margin: 20px 0;
        }
        
        .current-price {
            font-size: 28px;
            font-weight: 700;
            color: #f7444e;
            margin-right: 15px;
        }
        
        .original-price {
            font-size: 20px;
            color: #999;
            text-decoration: line-through;
        }
        
        .discount-badge {
            background: #f7444e;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            margin-left: 15px;
        }
        
        .product-description {
            margin: 25px 0;
            padding: 20px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }
        
        .product-description h4 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin: 25px 0;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            border: 1px solid #ddd;
            background: #f8f9fa;
            font-size: 18px;
            cursor: pointer;
        }
        .quantity-input {
    -moz-appearance: textfield;
    -webkit-appearance: textfield;
    margin: 0;
}

.quantity-input::-webkit-outer-spin-button,
.quantity-input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.btn-lg {
    min-height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

@media (max-width: 576px) {
    .d-md-flex {
        flex-direction: column;
        gap: 10px !important;
    }
    
    .btn-lg {
        width: 100%;
    }
}
        
        .btn-add-to-cart {
            background: #f7444e;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: uppercase;
        }
        
        .btn-add-to-cart:hover {
            background: #e63a42;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(247, 68, 78, 0.2);
        }
        
        .btn-buy-now {
            background: #2c3e50;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 15px;
            transition: all 0.3s;
        }
        
        .btn-buy-now:hover {
            background: #1a252f;
            transform: translateY(-2px);
        }
        
        .product-meta {
            margin: 25px 0;
        }
        
        .product-meta p {
            margin-bottom: 10px;
            font-size: 15px;
        }
        
        .product-meta strong {
            color: #2c3e50;
            margin-right: 10px;
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
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #2c3e50;
            position: relative;
            padding-bottom: 15px;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background: #f7444e;
        }
        
        .product-card {
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            margin-bottom: 30px;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .product-card-img {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f8f9fa;
        }
        
        .product-card-img img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }
        
        .product-card-body {
            padding: 20px;
        }
        
        .product-card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #2c3e50;
            height: 40px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .product-card-price {
            font-size: 18px;
            font-weight: 700;
            color: #f7444e;
            margin-bottom: 15px;
        }
        
        .product-card-original-price {
            font-size: 14px;
            color: #999;
            text-decoration: line-through;
            margin-left: 8px;
        }
        
        .btn-view-details {
            width: 100%;
            padding: 8px;
            background: #f8f9fa;
            color: #2c3e50;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .btn-view-details:hover {
            background: #f7444e;
            color: white;
            border-color: #f7444e;
        }
        
        @media (max-width: 991px) {
            .product-image {
                border-right: none;
                border-bottom: 1px solid #eee;
            }
            
            .product-info {
                padding: 20px;
            }
            
            .btn-add-to-cart,
            .btn-buy-now {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>
<body>

        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->


    <!-- Product Details Section -->
    <section class="product_section layout_padding">
        <div class="container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mb-4">
                            <i class="fas fa-arrow-left me-2"></i>Back to Products
                        </a>
                    </div>
                </div>
                <div class="product-container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-image">
                                <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->title }}" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-lg-6">
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

                                <div class="product-actions">
                                @if(Auth::check())
    <form action="{{ route('add.to.cart', $product->id) }}" method="POST" class="w-100">
        @csrf
        <div class="d-flex flex-column">
            <div class="mb-3">
                <label class="form-label fw-bold d-block mb-2">Quantity:</label>
                <div class="quantity-selector d-inline-flex align-items-center">
                    <button type="button" class="quantity-btn" onclick="decreaseQuantity()" style="width: 40px; height: 40px; border: 1px solid #ddd; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">-</button>
                    <input type="number" name="quantity" id="quantity" class="quantity-input" value="1" min="1" max="{{ $product->quantity }}" style="width: 60px; height: 40px; text-align: center; border: 1px solid #ddd; border-left: none; border-right: none;">
                    <button type="button" class="quantity-btn" onclick="increaseQuantity()" style="width: 40px; height: 40px; border: 1px solid #ddd; background: #f8f9fa; display: flex; align-items: center; justify-content: center;">+</button>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button type="submit" class="btn-add-to-cart flex-grow-1" style="min-width: 200px;">
                    <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                </button>
                <a href="#" class="btn-buy-now flex-grow-1" style="min-width: 200px; background: #2c3e50; color: white; border: none; padding: 12px 30px; font-size: 16px; font-weight: 600; border-radius: 5px; cursor: pointer; text-align: center; text-decoration: none; display: inline-flex; align-items: center; justify-content: center;">
                    <i class="fas fa-bolt me-2"></i>Buy Now
                </a>
            </div>
        </div>
    </form>
@else
    <div class="alert alert-warning">
        Please <a href="{{ route('login') }}" class="alert-link">login</a> to add items to your cart.
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('login') }}" class="btn btn-primary flex-grow-1" style="min-width: 200px;">
            <i class="fas fa-sign-in-alt me-2"></i>Login to Continue
        </a>
    </div>
@endif

                                <div class="product-meta">
                                    <p><strong>Category:</strong> {{ $product->category_name ?? 'N/A' }}</p>
                                    <p><strong>Availability:</strong> 
                                        @if($product->quantity > 0)
                                            <span class="in-stock">In Stock ({{ $product->quantity }})</span>
                                        @else
                                            <span class="out-of-stock">Out of Stock</span>
                                        @endif
                                    </p>
                                    <p><strong>SKU:</strong> {{ $product->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Products -->
                @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                <div class="related-products">
                    <h3 class="section-title">You May Also Like</h3>
                    <div class="row">
                        @foreach($relatedProducts as $related)
                        <div class="col-md-3 col-6">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <img src="{{ asset('product/'.$related->image) }}" alt="{{ $related->title }}">
                                </div>
                                <div class="product-card-body">
                                    <h5 class="product-card-title">{{ $related->title }}</h5>
                                    <div class="product-card-price">
                                        @if($related->discount_price)
                                            ${{ number_format($related->discount_price, 2) }}
                                            <span class="product-card-original-price">${{ number_format($related->price, 2) }}</span>
                                        @else
                                            ${{ number_format($related->price, 2) }}
                                        @endif
                                    </div>
                                    <a href="{{ route('product.details', $related->id) }}" class="btn btn-view-details">
                                        <i class="fas fa-eye me-1"></i> View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- footer start -->
    @include('home.footer')
    <!-- footer end -->
    
    <div class="cpy_">
        <p class="mx-auto">  {{ date('Y') }} All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
        </p>
    </div>
    
    <!-- jQery -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('home/js/custom.js') }}"></script>
    <script>
        function increaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var maxQuantity = parseInt(quantityInput.max);
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity < maxQuantity) {
                quantityInput.value = currentQuantity + 1;
            }
        }

        function decreaseQuantity() {
            var quantityInput = document.getElementById('quantity');
            var currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) {
                quantityInput.value = currentQuantity - 1;
            }
        }

        // Prevent form submission on Enter key
        document.getElementById('quantity').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }
        });
    </script>
</body>
</html>