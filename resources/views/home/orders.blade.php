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
      <title>My Orders - Ecommerce</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <!-- Font Awesome for icons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
      <style>
         .badge {
             font-size: 0.85em;
             padding: 0.4em 0.8em;
         }
         .badge-success {
             background-color: #28a745;
         }
         .badge-warning {
             background-color: #ffc107;
             color: #212529;
         }
         .badge-danger {
             background-color: #dc3545;
         }
         .table {
             background: #fff;
             border-radius: 5px;
             box-shadow: 0 0 10px rgba(0,0,0,0.1);
         }
         .table th {
             background: #f8f9fa;
             border-bottom: 2px solid #dee2e6;
         }
      </style>
   </head>
   <body>
      
         <!-- header section -->
         @include('home.header')
         <!-- end header section -->

      <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-4">My Orders</h2>
            
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($orders->isEmpty())
                <div class="alert alert-info">
                    You haven't placed any orders yet.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ $order->items->sum('quantity') }}</td>
                                    <td>${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'completed') badge-success
                                            @elseif($order->status == 'cancelled') badge-danger
                                            @else badge-warning @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('user.orders.show', $order->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                        @if(in_array($order->status, ['pending', 'processing']))
                                            <form action="{{ route('user.orders.cancel', $order->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger" 
                                                        onclick="return confirm('Are you sure you want to cancel this order?')">
                                                    <i class="fas fa-times"></i> Cancel
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
            </div>
        </div>
      </div>

      <!-- footer start -->
      @include('home.footer')
      <!-- footer end -->
      
      <div class="cpy_">
         <p class="mx-auto"> 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a></p>
      </div>
      
      <!-- jQery -->
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <!-- popper js -->
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <!-- bootstrap js -->
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <!-- custom js -->
      <script src="{{ asset('home/js/custom.js') }}"></script>
      <!-- Initialize dropdowns -->
      <script>
         $(document).ready(function() {
             $('.dropdown-toggle').dropdown();
         });
      </script>
   </body>
</html>
