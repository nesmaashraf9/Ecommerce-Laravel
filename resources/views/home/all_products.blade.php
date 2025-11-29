<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>All Products - Ecommerce</title>
    <link rel="stylesheet" href="{{ asset('home/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/responsive.css') }}">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #ffffff);
            font-family: "Poppins", sans-serif;
        }
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            text-align: center;
            color: #2c3e50;
            position: relative;
        }
        .section-title span {
            color: #f7444e;
        }
        .section-title::after {
            content: "";
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: #f7444e;
        }
        .product-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .product-img-container {
            height: 250px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fafafa;
        }
        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        .product-card:hover .product-img {
            transform: scale(1.05);
        }
        .product-body {
            padding: 20px;
            text-align: center;
        }
        .product-title {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
        }
        .price-container {
            margin-top: 10px;
        }
        .current-price {
            color: #f7444e;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .original-price {
            color: #999;
            text-decoration: line-through;
            margin-right: 5px;
        }
        .btn-add-to-cart {
            background: #f7444e;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 15px;
            margin-top: 10px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-add-to-cart:hover {
            background: #e63a42;
        }
        .btn-search {
            background: #f7444e;
            color: white;
            border: none;
            font-weight: 600;
            padding: 8px 20px;
        }
        .btn-search:hover {
            background: #e63a42;
        }
    </style>
</head>

<body>
    @include('home.header')

    <section class="product_section py-5">
        <div class="container">
            <h1 class="section-title">Our <span>Products</span></h1>

            <!-- Search -->
            <div class="search-container my-4">
                <form id="searchForm" action="{{ route('all.products') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" id="searchInput" class="form-control"
                            placeholder="Search Products by Name or Category..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-search" type="submit">
                                <i class="fa fa-search"></i> Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Products -->
            <div class="row" id="productsContainer">
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
                                        <span class="original-price">${{ $product->price }}</span>
                                        <span class="current-price">${{ $product->discount_price }}</span>
                                    @else
                                        <span class="current-price">${{ $product->price }}</span>
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
            </div>

            <!-- Pagination -->
            <div class="pagination-container text-center mt-4">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </section>

    @include('home.footer')

    <!-- JS -->
    <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('home/js/popper.min.js') }}"></script>
    <script src="{{ asset('home/js/bootstrap.js') }}"></script>

  <!-- ✅ AJAX Search -->
<script>
$(document).ready(function () {
    // Handle search form submission
    $('#searchForm').on('submit', function (e) {
        e.preventDefault();
        const form = $(this);
        const url = form.attr('action');
        const query = form.serialize();
        
        // Show loading state
        $('#productsContainer').html(`
            <div class="col-12 text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p class="mt-2">Loading products...</p>
            </div>
        `);

        $.ajax({
            url: url,
            type: 'GET',
            data: query,
            dataType: 'json',
            success: function (response) {
                if (response.html) {
                    $('#productsContainer').html(response.html);
                    $('.pagination-container').html(response.pagination);
                    window.history.pushState({}, '', url + '?' + query);
                }
            },
            error: function (xhr) {
                console.error('Search failed:', xhr.responseText);
                $('#productsContainer').html(`
                    <div class="col-12 text-center py-5">
                        <div class="alert alert-danger">
                            Error loading products. Please try again.
                        </div>
                    </div>
                `);
            }
        });
    });

    // Handle pagination links
    $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href');
        $('#searchForm').attr('action', url.split('?')[0]);
        $('#searchForm').submit();
    });

    // Handle back/forward browser buttons
    window.addEventListener('popstate', function() {
        location.reload();
    });
});
</script>
</body>
</html>
