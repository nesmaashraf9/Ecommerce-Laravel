<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>Order Confirmation - Ecommerce</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <style>
        .order-confirmation {
            padding: 60px 0;
            text-align: center;
        }
        .order-card {
            background: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin: 20px auto;
            max-width: 800px;
        }
        .success-icon {
            font-size: 80px;
            color: #28a745;
            margin-bottom: 20px;
        }
        .order-details {
            text-align: left;
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
        }
        .order-total {
            font-size: 20px;
            font-weight: 600;
            color: #f7444e;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .btn-continue {
            background: #f7444e;
            color: white;
            padding: 12px 30px;
            font-weight: 600;
            border: none;
            border-radius: 4px;
            margin-top: 30px;
            transition: all 0.3s;
        }
        .btn-continue:hover {
            background: #e63a42;
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
      </style>
   </head>
   <body>
      @include('home.header')
      
      <section class="order-confirmation">
         <div class="container">
            <div class="order-card">
               <div class="success-icon">
                  <i class="fa fa-check-circle"></i>
               </div>
               <h2>Thank You For Your Order!</h2>
               <p class="lead">Your order has been received and is being processed.</p>
               <p>Order #{{ $order->id }} | {{ $order->created_at->format('F j, Y') }}</p>
               
               <div class="order-details">
                  <h4>Order Summary</h4>
                  @foreach($order->items as $item)
                     <div class="order-item">
                        <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
                        <span>${{ number_format($item->price * $item->quantity, 2) }}</span>
                     </div>
                  @endforeach
                  
                  <div class="order-total">
                     <span>Total: ${{ number_format($order->total, 2) }}</span>
                  </div>
               </div>
               
               <div class="shipping-details mt-4">
                  <h4>Shipping Details</h4>
                  <p>
                     {{ $order->first_name }} {{ $order->last_name }}<br>
                     {{ $order->address }}<br>
                     {{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}<br>
                     {{ $order->country }}<br>
                     {{ $order->email }}<br>
                     {{ $order->phone }}
                  </p>
               </div>
               
               <a href="{{ route('all.products') }}" class="btn btn-continue">Continue Shopping</a>
            </div>
         </div>
      </section>

      @include('home.footer')
      
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>
   </body>
</html>
