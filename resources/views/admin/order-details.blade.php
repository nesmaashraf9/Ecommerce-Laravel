<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="{{ url('/') }}">
    @include('admin.css')
    <style>
      .order-details-card {
        margin-bottom: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
      }
      .order-item {
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
      }
      .order-item:last-child {
        border-bottom: none;
      }
      .order-item-img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
        flex-shrink: 0;
        object-fit: cover;
        border-radius: 4px;
      }
      .order-summary {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
      }
      .page-title {
        margin-bottom: 1.5rem;
      }
      .card-title {
        font-weight: 500;
        margin-bottom: 1.5rem;
      }
      .order-status {
        font-size: 0.875rem;
        padding: 0.35rem 0.75rem;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      <div class="container-fluid page-body-wrapper">
        @include('admin.header')
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <a href="{{ route('admin.orders') }}" class="btn btn-light btn-icon-text mr-2">
                  <i class="mdi mdi-arrow-left"></i> Back to Orders
                </a>
                Order #{{ $order->id }}
              </h3>
            </div>

            @if(session()->has('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <div class="row">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card order-details-card">
                  <div class="card-body">
                    <h4 class="card-title">Order Items</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($order->items as $item)
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <div class="mr-3">
                                  @php
                                    $imagePath = 'https://via.placeholder.com/80x80?text=No+Image';
                                    
                                    if ($item->product && $item->product->image) {
                                        if (str_starts_with($item->product->image, 'http')) {
                                            $imagePath = $item->product->image;
                                        } else {
                                            // Check if the image exists in the public path
                                            $imageName = basename($item->product->image);
                                            $publicPath = 'product/' . $imageName;
                                            
                                            if (file_exists(public_path($publicPath))) {
                                                $imagePath = asset($publicPath);
                                            } elseif (file_exists(public_path('storage/' . $item->product->image))) {
                                                $imagePath = asset('storage/' . $item->product->image);
                                            }
                                        }
                                    }
                                  @endphp
                                  <img src="{{ $imagePath }}" alt="{{ $item->product_name }}" class="order-item-img" onerror="this.src='https://via.placeholder.com/80x80?text=No+Image';">
                                </div>
                                <div>
                                  <h6 class="mb-1">{{ $item->product_name }}</h6>
                                  <small class="text-muted">SKU: {{ $item->product ? $item->product->id : 'N/A' }}</small>
                                </div>
                              </div>
                            </td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-4 grid-margin">
                <div class="card order-details-card">
                  <div class="card-body">
                    <h4 class="card-title">Order Summary</h4>
                    <div class="order-summary">
    <h5 class="text-primary mb-3">Order Summary</h5>
    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Subtotal:</span>
        <span class="font-weight-bold text-dark">${{ number_format($order->subtotal, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between mb-2">
        <span class="text-muted">Shipping:</span>
        <span class="font-weight-bold text-info">${{ number_format($order->shipping, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Tax:</span>
        <span class="font-weight-bold text-warning">${{ number_format($order->tax, 2) }}</span>
    </div>
    <div class="d-flex justify-content-between mb-3">
        <span class="text-muted">Payment Method:</span>
        <span class="font-weight-bold" style="color: #6772e5;">
            @if($order->payment_id)
                <i class="mdi mdi-credit-card-check-outline"></i> Credit Card (Stripe)
            @else
                <i class="mdi mdi-cash"></i> Cash on Delivery
            @endif
        </span>
    </div>
    <hr class="my-3">
    <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Total:</h5>
        <h4 class="mb-0 font-weight-bold text-success">${{ number_format($order->total, 2) }}</h4>
    </div>
</div>
                  </div>
                </div>

                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customer Information</h4>
                    <div class="mt-3">
                      <h6>{{ $order->first_name }} {{ $order->last_name }}</h6>
                      <p class="mb-1">{{ $order->email }}</p>
                      <p class="mb-1">{{ $order->phone }}</p>
                      <p class="mb-0">{{ $order->address }}</p>
                      <p class="mb-0">{{ $order->city }}, {{ $order->state }} {{ $order->zip_code }}</p>
                      <p class="mb-0">{{ $order->country }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('admin.script')
  </body>
</html>
