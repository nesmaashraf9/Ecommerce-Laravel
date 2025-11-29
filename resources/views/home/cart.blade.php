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
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>Your Cart - Ecommerce</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <style>
        .cart_section {
            padding: 60px 0;
        }
        .cart_table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: separate;
            border-spacing: 0 15px;
        }
        .cart_table th {
            background: #f5f5f5;
            padding: 15px;
            text-align: center;
            font-weight: 600;
        }
        .cart_table td {
            padding: 20px;
            vertical-align: middle;
            text-align: center;
            background: #fff;
            border: 1px solid #eee;
        }
        .cart_item_image img {
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }
        
        .out-of-stock {
            opacity: 0.7;
            position: relative;
        }
        
        .out-of-stock::after {
            content: "Out of Stock";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            text-align: center;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            padding: 5px;
            font-weight: bold;
        }
        
        .quantity-btn:disabled, 
        .quantity-input:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        .btn-add-to-cart:disabled {
            background-color: #6c757d;
            cursor: not-allowed;
        }
        .quantity-selector {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin: 0 auto;
            max-width: 140px;
        }
        .quantity-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #dee2e6;
            background: #f8f9fa;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
            color: #333;
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
            color: #fff;
            border-color: #f7444e;
            transform: translateY(-1px);
        }
        .quantity-input {
            width: 50px;
            height: 32px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
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
            box-shadow: 0 0 0 0.2rem rgba(247, 68, 78, 0.1);
            outline: none;
        }
        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        .out-of-stock {
            position: relative;
        }
        .out-of-stock::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 0, 0, 0.03);
            pointer-events: none;
        }
        .stock-warning {
            font-size: 0.8rem;
            color: #dc3545;
            margin-top: 5px;
        }
        .btn-update {
            background: #f7444e;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .btn-update:hover {
            background: #d63c44;
            transform: translateY(-2px);
        }
        .cart_totals {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 5px;
            margin-top: 30px;
        }
        .cart_totals h4 {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .btn-checkout {
            background: #28a745;
            color: white;
            padding: 10px 25px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-checkout:hover {
            background: #218838;
            transform: translateY(-2px);
        }
        .cart-empty {
            text-align: center;
            padding: 50px 0;
        }
        .cart-empty i {
            font-size: 80px;
            color: #ddd;
            margin-bottom: 20px;
        }
      </style>
   </head>
   <body>
        <!-- header section strats -->
        @include('home.header')

        <!-- cart section -->
        <section class="cart_section">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2>Your <span>Cart</span></h2>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session()->has('cart') && count((array) session('cart')) > 0)
                    <div class="table-responsive">
                        <table class="table cart_table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total = 0 @endphp
                                @foreach(session('cart') as $id => $details)
                                    @php 
                                        $product = \App\Models\Product::find($id);
                                        $maxQty = $product ? $product->quantity : 0;
                                        $outOfStock = $product && $product->quantity < $details['quantity'];
                                        $itemTotal = $details['price'] * $details['quantity'];
                                        $total += $itemTotal;
                                    @endphp
                                    
                                    <tr data-id="{{ $id }}" class="{{ $outOfStock ? 'out-of-stock' : '' }}">
                                        <td class="cart_item">
                                            <div class="d-flex align-items-center">
                                                <div class="cart_item_image me-3">
                                                    <img src="{{ asset('product/'.$details['image']) }}" alt="{{ $details['name'] }}" />
                                                </div>
                                                <div class="cart_item_info">
                                                    <h6 class="mb-1">{{ $details['name'] }}</h6>
                                                    @if($outOfStock)
                                                        <div class="stock-warning">
                                                            <i class="fa fa-exclamation-circle"></i> Only {{ $maxQty }} available
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart_price">${{ number_format($details['price'], 2) }}</td>
                                        <td>
                                            <form action="{{ route('update.cart') }}" method="POST" class="d-inline update-cart-form">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <div class="quantity-selector">
                                                    <button type="submit" name="change_quantity" value="decrease" 
                                                            class="quantity-btn" 
                                                            {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                                                        -
                                                    </button>
                                                    <input type="number" 
                                                           name="quantity" 
                                                           value="{{ $details['quantity'] }}" 
                                                           class="quantity-input update-cart" 
                                                           min="1" 
                                                           max="{{ $maxQty }}"
                                                           {{ $outOfStock ? 'disabled' : '' }}>
                                                    <button type="submit" 
                                                            name="change_quantity" 
                                                            value="increase" 
                                                            class="quantity-btn" 
                                                            {{ $outOfStock || $details['quantity'] >= $maxQty ? 'disabled' : '' }}>
                                                        +
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                        <td class="cart_total">${{ number_format($itemTotal, 2) }}</td>
                                        <td class="cart_remove">
                                            <form action="{{ route('remove.from.cart') }}" method="POST" class="d-inline remove-from-cart-form">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="id" value="{{ $id }}">
                                                <button type="submit" class="btn btn-sm btn-danger remove-from-cart" title="Remove">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><h5 class="mb-0">Subtotal</h5></td>
                                    <td colspan="2" class="text-center"><h5 class="mb-0">${{ number_format($total, 2) }}</h5></td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <a href="{{ url('/') }}" class="btn btn-outline-secondary me-2">
                                            <i class="fa fa-arrow-left"></i> Continue Shopping
                                        </a>
                                        <a href="{{ route('checkout') }}" 
                                           class="btn btn-checkout {{ $outOfStock ? 'disabled' : '' }}"
                                           {{ $outOfStock ? 'aria-disabled="true" tabindex="-1"' : '' }}>
                                            Proceed to Checkout <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                @else
                    <div class="cart-empty">
                        <i class="fa fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Looks like you haven't added anything to your cart yet</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">
                            <i class="fa fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                    </div>
                @endif
            </div>
        </section>
        <!-- end cart section -->

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->

        <!-- jQery -->
        <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ asset('home/js/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('home/js/bootstrap.js') }}"></script>
        <!-- custom js -->
        <script src="{{ asset('home/js/custom.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize button states on page load
                $('.quantity-input').each(function() {
                    updateQuantityButtons($(this));
                });
            });

            // Handle quantity changes when clicking plus/minus buttons
            $(document).on('click', '.quantity-btn', function(e) {
                e.preventDefault();
                
                var button = $(this);
                var form = button.closest('form');
                var input = form.find('.quantity-input');
                var currentVal = parseInt(input.val()) || 1;
                var max = parseInt(input.data('max')) || 9999;
                var min = parseInt(input.data('min')) || 1;
                var change = button.val() === 'increase' ? 1 : -1;
                var newVal = currentVal + change;
                
                // Validate new value
                newVal = Math.max(min, Math.min(max, newVal));
                
                // Only proceed if value actually changed
                if (newVal !== currentVal) {
                    input.val(newVal);
                    updateQuantityButtons(input);
                    submitCartForm(form);
                }
            });

            // Handle manual input changes with debounce
            var quantityTimeout;
            $(document).on('change input', '.quantity-input', function() {
                clearTimeout(quantityTimeout);
                var input = $(this);
                
                quantityTimeout = setTimeout(function() {
                    var max = parseInt(input.data('max')) || 9999;
                    var min = parseInt(input.data('min')) || 1;
                    var value = parseInt(input.val()) || min;
                    
                    // Validate input
                    value = Math.max(min, Math.min(max, value));
                    
                    if (value !== parseInt(input.val())) {
                        input.val(value);
                    }
                    
                    updateQuantityButtons(input);
                    submitCartForm(input.closest('form'));
                }, 500); // 500ms delay
            });

            // Update button states based on current value
            function updateQuantityButtons(input) {
                var form = input.closest('form');
                var value = parseInt(input.val()) || 1;
                var max = parseInt(input.data('max')) || 9999;
                var min = parseInt(input.data('min')) || 1;
                
                form.find('button[value="decrease"]').prop('disabled', value <= min);
                form.find('button[value="increase"]').prop('disabled', value >= max);
            }

            // Handle remove from cart
            $(document).on('submit', '.remove-from-cart-form', function(e) {
                e.preventDefault();
                if (confirm('Are you sure you want to remove this item?')) {
                    submitCartForm($(this));
                }
            });

            // Centralized function to handle form submission
            function submitCartForm(form) {
                var submitBtn = form.find('button[type="submit"]');
                var originalText = submitBtn.html();
                
                // Disable buttons and show loading state
                submitBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
                
                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            // Update cart count if available
                            if (response.cart_count !== undefined) {
                                $('.cart-count').text(response.cart_count);
                            }
                            // Update subtotal if available
                            if (response.subtotal !== undefined) {
                                $('.cart-subtotal').text('$' + parseFloat(response.subtotal).toFixed(2));
                            }
                            // Reload to reflect all changes
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred while updating the cart. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.status === 500) {
                            errorMessage = 'Server error. Please try again later.';
                        }
                        alert(errorMessage);
                    },

                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalText);
                    }
                });
            }
        </script>
   </body>
</html>