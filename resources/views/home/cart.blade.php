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
        }
        .cart_table th {
            background: #f5f5f5;
            padding: 15px;
            text-align: center;
        }
        .cart_table td {
            padding: 20px;
            vertical-align: middle;
            text-align: center;
        }
        .cart_item_image img {
            max-width: 100px;
            height: auto;
        }
        .quantity {
            width: 70px;
            text-align: center;
        }
        .btn-update {
            background: #f7444e;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-update:hover {
            background: #d63c44;
        }
        .cart_totals {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 5px;
        }
        .cart_totals h4 {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
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
                <div class="alert alert-success">
                    {{ session('success') }}
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
                                @php $total += $details['price'] * $details['quantity'] @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="cart_item">
                                        <div class="d-flex align-items-center">
                                            <div class="cart_item_image">
                                                <img src="{{ asset('product/'.$details['image']) }}" alt="{{ $details['name'] }}" />
                                            </div>
                                            <div class="cart_item_info ms-3">
                                                <h6>{{ $details['name'] }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart_price">${{ number_format($details['price'], 2) }}</td>
                                    <td>
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" min="1" />
                                    </td>
                                    <td class="cart_total">${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                                    <td class="cart_remove">
                                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total</strong></td>
                                <td colspan="2" class="text-center"><strong>${{ number_format($total, 2) }}</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-end">
                                    <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                                    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout <i class="fa fa-angle-right"></i></a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            @else
                <div class="text-center">
                    <h4>Your cart is empty</h4>
                    <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
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
        $(".update-cart").change(function (e) {
            e.preventDefault();
            
            var ele = $(this);
            
            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("tr").attr("data-id"), 
                    quantity: ele.val()
                },
                success: function (response) {
                   window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            
            var ele = $(this);
            
            if(confirm("Are you sure you want to remove this item?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
   </body>
</html>
