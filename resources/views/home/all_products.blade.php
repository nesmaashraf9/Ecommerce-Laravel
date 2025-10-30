<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="Browse our wide selection of products" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}" type="">
    <title>All Products - Ecommerce</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <!-- font awesome style -->
    <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        
        .product_section {
            padding: 90px 0;
        }
        
        .heading_container {
            margin-bottom: 50px;
            text-align: center;
        }
        
        .heading_container h2 {
            position: relative;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0;
        }
        
        .heading_container h2 span {
            color: #f7444e;
        }
        
        /* Product Box Styles */
        .box {
            position: relative;
            margin-top: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            color: #1a1a1a;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .sale-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f7444e;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            z-index: 1;
        }
        
        .img-box {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px;
            background: #f8f9fa;
            height: 250px;
        }
        
        .img-box img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        .detail-box {
            padding: 15px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .detail-box h5 {
            margin: 10px 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }
        
        .detail-box h6 {
            margin: 5px 0 15px;
            font-size: 18px;
        }
        
        /* Price Styling */
        .original-price {
            text-decoration: line-through;
            color: #999;
            margin-right: 5px;
            font-size: 14px;
        }
        
        .discount-price {
            color: #f7444e;
            font-weight: 600;
        }
        
        .current-price {
            color: #333;
            font-weight: 600;
        }
        
        /* Quantity Container */
        .quantity-container {
            margin-top: 10px;
            width: 100%;
            position: relative;
            z-index: 3;
        }
        
        .quantity-selector {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            font-size: 16px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        
        .quantity-input {
            width: 40px;
            height: 30px;
            text-align: center;
            border: 1px solid #ddd;
            border-left: none;
            border-right: none;
            -moz-appearance: textfield;
        }
        
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        .add-to-cart-btn {
            background: #f7444e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            width: 100%;
            max-width: 200px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            display: block;
            margin: 0 auto;
        }
        
        .add-to-cart-btn:hover {
            background: #e63a42;
        }
        
        /* Option Container */
        .option_container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: calc(100% - 100px);
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.9);
            opacity: 0;
            transition: all 0.3s;
            z-index: 2;
            pointer-events: none;
        }
        
        .box:hover .option_container {
            opacity: 1;
        }
        
        .options {
            display: flex;
            flex-direction: column;
            align-items: center;
            pointer-events: auto;
        }
        
        .option1,
        .option2 {
            display: inline-block;
            padding: 8px 25px;
            background-color: #f7444e;
            color: #ffffff;
            border-radius: 5px;
            margin: 5px;
            text-decoration: none;
            transition: all 0.3s;
            border: 1px solid #f7444e;
            width: 150px;
            text-align: center;
        }
        
        .option1:hover,
        .option2:hover {
            background-color: transparent;
            color: #f7444e;
        }
        
        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            padding: 0;
            list-style: none;
        }
        
        .pagination > li {
            margin: 0 5px;
        }
        
        .pagination > li > a,
        .pagination > li > span {
            padding: 8px 16px;
            border: 1px solid #ddd;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.3s;
        }
        
        .pagination > .active > a,
        .pagination > .active > span {
            background-color: #f7444e;
            color: white;
            border-color: #f7444e;
        }
        
        .pagination > li > a:hover {
            background-color: #f8f9fa;
            border-color: #ddd;
        }
        
        .btn-box {
            text-align: center;
            margin-top: 30px;
        }
        
        .btn-box a {
            display: inline-block;
            padding: 10px 30px;
            background-color: #f7444e;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .btn-box a:hover {
            background-color: #e63a42;
            transform: translateY(-2px);
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .product_section {
                padding: 60px 0;
            }
            
            .heading_container {
                margin-bottom: 30px;
            }
            
            .img-box {
                height: 200px;
            }
            
            .quantity-selector {
                max-width: 130px;
                margin: 0 auto 10px;
            }
            
            .add-to-cart-btn {
                padding: 7px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
@include('home.header')
    <!-- Products Section -->
    <section class="product_section">
        <div class="container">
            <div class="heading_container">
                <h2>All <span>Products</span></h2>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="box">
                        @if($product->discount_price)
                        <div class="sale-badge">Sale</div>
                        @endif
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('product.details', $product->id) }}" class="option1">
                                    Product Details
                                </a>
                                <a href="#" class="option2">
                                    Buy Now
                                </a>
                            </div>
                        </div>
                        <div class="img-box">
                            <img src="{{ asset('product/'.$product->image) }}" alt="{{ $product->title }}">
                        </div>
                        <div class="detail-box">
                            <h5>{{ $product->title }}</h5>
                            <h6>
                                @if($product->discount_price)
                                    <span class="original-price">${{ number_format($product->price, 2) }}</span>
                                    <span class="discount-price">${{ number_format($product->discount_price, 2) }}</span>
                                @else
                                    <span class="current-price">${{ number_format($product->price, 2) }}</span>
                                @endif
                            </h6>
                            
                            <!-- Quantity Selector -->
                            <div class="quantity-container">
                                <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn minus" style="border-color:rgb(243, 241, 241);">-</button>
                                        <input type="number" name="quantity" value="1" min="1" class="quantity-input" readonly>
                                        <button type="button" class="quantity-btn plus" style="border-color:rgb(243, 241, 241);">+</button>
                                    </div>
                                    <button type="submit" class="add-to-cart-btn">
                                        <i class="fas fa-shopping-cart"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="btn-box">
                <a href="{{ route('all.products') }}">
                    View All Products
                </a>
            </div>
            <div class="pagination-container">
                {{ $products->links() }}
            </div>
        </div>
    </section>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove the jQuery quantity control since we're using vanilla JS
        // This prevents duplicate event handling
        
        // Quantity controls - using event delegation
        document.addEventListener('click', function(e) {
            if (e.target.matches('.quantity-btn')) {
                const input = e.target.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value) || 1;
                const max = parseInt(input.getAttribute('max')) || 999;
                
                if (e.target.classList.contains('plus') && value < max) {
                    input.value = value + 1;
                } else if (e.target.classList.contains('minus') && value > 1) {
                    input.value = value - 1;
                }
            }
        });

        // Keep the rest of your AJAX form submission code
        $('form').on('submit', function(e) {
            e.preventDefault();
            
            const form = $(this);
            const button = form.find('.add-to-cart-btn');
            const buttonText = button.html();
            
            // Show loading state
            button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Adding...');
            
            // Get the product ID from the form action
            const url = form.attr('action');
            
            // Submit the form via AJAX
            $.ajax({
                url: url,
                method: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Show success message
                    const successMsg = $('<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        '<span>Product added to cart successfully!</span>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');
                    
                    // Insert the alert before the products section
                    $('.product_section .container').prepend(successMsg);
                    
                    // Remove the alert after 3 seconds
                    setTimeout(function() {
                        successMsg.fadeOut(300, function() {
                            $(this).remove();
                        });
                    }, 3000);
                    
                    // Update cart count in navigation if needed
                    updateCartCount();
                },
                error: function(xhr) {
                    // Show error message
                    const errorMsg = $('<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        '<span>Error adding product to cart. Please try again.</span>' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>');
                    
                    $('.product_section .container').prepend(errorMsg);
                    
                    // Remove the alert after 3 seconds
                    setTimeout(function() {
                        errorMsg.fadeOut(300, function() {
                            $(this).remove();
                        });
                    }, 3000);
                },
                complete: function() {
                    // Reset button state
                    button.prop('disabled', false).html(buttonText);
                }
            });
        });
        
        // Function to update cart count in navigation
        function updateCartCount() {
            $.get('{{ route("cart.count") }}', function(response) {
                if (response.count > 0) {
                    $('.cart-count').text(response.count).show();
                } else {
                    $('.cart-count').hide();
                }
            });
        }
    });
</script>
<!-- Add this style for the cart count badge -->
<style>
    .cart-count {
        position: absolute;
        top: -5px;
        right: -5px;
        background-color: #f7444e;
        color: white;
        border-radius: 50%;
        width: 18px;
        height: 18px;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
</body>
</html>