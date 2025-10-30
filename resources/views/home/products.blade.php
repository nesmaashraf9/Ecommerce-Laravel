<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Our <span>products</span></h2>
        </div>
        <div class="row">
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
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quantity controls
    document.querySelectorAll('.quantity-btn').forEach(button => {
        button.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.quantity-input');
            let value = parseInt(input.value) || 1;
            const max = parseInt(input.getAttribute('max')) || 999;
            
            if (this.classList.contains('plus') && value < max) {
                input.value = value + 1;
            } else if (this.classList.contains('minus') && value > 1) {
                input.value = value - 1;
            }
        });
    });
    
    // Prevent form submission on enter key
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });
});
</script>