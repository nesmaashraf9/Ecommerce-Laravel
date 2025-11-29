<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center mb-4">
            <h2>Our <span>products</span></h2>
        </div>
        
        <!-- Search Bar -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <form id="searchForm" class="search-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control" 
                               placeholder="Search products by name or category..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                            @if(request()->has('search'))
                                <button type="button" id="clearSearch" class="btn btn-outline-secondary ml-2">
                                    <i class="fa fa-times"></i> Clear
                                </button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="products-container">
            <div class="row" id="products-row">
                @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        @if($product->discount_price)
                        <div class="sale-badge">Sale</div>
                        @endif
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ route('product.details', $product->id) }}" class="option1">
                                    Product Details
                                </a>
                                <a href="" class="option2">
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
                                <form action="" method="POST">
                                    @csrf
                                    <div class="quantity-selector">
                                        <button type="button" class="quantity-btn minus"  style="border-color:rgb(243, 241, 241);">-</button>
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
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $products->withQueryString()->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        <div class="btn-box">
            <a href="{{ route('all.products') }}">
                View All Products
            </a>
        </div>
    </div>
</section>

<style>
/* Sale Badge */
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

/* Add this to your existing styles */
.quantity-container {
    margin-top: 10px;
    width: 100%;
    position: relative; /* Add this */
    z-index: 3; /* Higher than the overlay's z-index */
}

/* Update the option container's z-index */
.option_container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: calc(100% - 100px); /* Adjust this value based on your layout */
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    opacity: 0;
    transition: all 0.3s;
    z-index: 2; /* This is lower than quantity container */
    pointer-events: none; /* This allows clicks to pass through to elements below */
}

/* Make the options clickable */
.option_container .options {
    pointer-events: auto;
}

/* Ensure the quantity buttons are clickable */
.quantity-btn {
    pointer-events: auto;
    position: relative;
    z-index: 4;
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
    transition: background 0.3s;
    display: block;
    margin: 0 auto;
}

.add-to-cart-btn:hover {
    background: #e63a42;
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

/* Ensure existing layout remains unchanged */


.box:hover {
    transform: translateY(-5px);
}

.option_container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(255, 255, 255, 0.9);
    opacity: 0;
    transition: all 0.3s;
    z-index: 2;
}

.box:hover .option_container {
    opacity: 1;
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
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .quantity-selector {
        max-width: 130px;
        margin: 0 auto 10px;
    }
    
    .add-to-cart-btn {
        padding: 7px 12px;
        font-size: 13px;
    }
}

/* Search Form Styling */
.search-form .form-control {
    height: 45px;
    border-radius: 4px 0 0 4px;
    border: 1px solid #ced4da;
    box-shadow: none;
}

.search-form .btn {
    height: 45px;
    border-radius: 0 4px 4px 0;
    min-width: 100px;
}

.search-form .input-group-append {
    margin-left: -1px;
}

/* Loading indicator */
#loading-indicator {
    display: none;
    text-align: center;
    padding: 20px 0;
}

#loading-indicator .spinner-border {
    width: 3rem;
    height: 3rem;
}

/* No results message */
#no-results {
    display: none;
    text-align: center;
    padding: 40px 0;
    color: #6c757d;
}

#no-results i {
    font-size: 48px;
    margin-bottom: 15px;
    color: #dee2e6;
}
</style>

<div id="loading-indicator" class="d-none">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div id="no-results" class="d-none">
    <i class="fa fa-search"></i>
    <h4>No products found</h4>
    <p>Try adjusting your search or filter to find what you're looking for.</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Quantity controls
    $(document).on('click', '.quantity-btn', function() {
        const $input = $(this).siblings('.quantity-input');
        let value = parseInt($input.val()) || 1;
        const max = parseInt($input.attr('max')) || 999;
        
        if ($(this).hasClass('plus') && value < max) {
            $input.val(value + 1);
        } else if ($(this).hasClass('minus') && value > 1) {
            $input.val(value - 1);
        }
    });

    // Handle search form submission
    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        const searchTerm = $('#searchInput').val().trim();
        loadProducts(searchTerm);
        // Update URL without page reload
        const url = new URL(window.location.href);
        if (searchTerm) {
            url.searchParams.set('search', searchTerm);
        } else {
            url.searchParams.delete('search');
        }
        window.history.pushState({}, '', url);
    });

    // Handle pagination links
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        loadProducts(null, url);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    
    // Handle clear search button
    $(document).on('click', '#clearSearch', function() {
        $('#searchInput').val('');
        loadProducts('');
        
        // Update URL without page reload
        const url = new URL(window.location.href);
        url.searchParams.delete('search');
        window.history.pushState({}, '', url);
    });

    // Load products via AJAX
    function loadProducts(searchTerm = null, url = null) {
        const $productsRow = $('#products-row');
        const $loadingIndicator = $('#loading-indicator');
        const $noResults = $('#no-results');
        
        $loadingIndicator.removeClass('d-none').show();
        $noResults.hide();
        
        // If no URL is provided, build it from the current URL
        if (!url) {
            url = '{{ route("all.products") }}';
            if (searchTerm) {
                url += '?search=' + encodeURIComponent(searchTerm);
            }
        }
        
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $loadingIndicator.hide();
                
                if (response.html.trim() === '') {
                    $noResults.removeClass('d-none').show();
                    $productsRow.html('');
                } else {
                    $productsRow.html(response.html);
                    $noResults.hide();
                }
                
                // Update pagination links
                $('.pagination').html(response.pagination);
            },
            error: function(xhr) {
                $loadingIndicator.hide();
                console.error('Error loading products:', xhr.responseText);
                alert('An error occurred while loading products. Please try again.');
            }
        });
    }
});
</script>