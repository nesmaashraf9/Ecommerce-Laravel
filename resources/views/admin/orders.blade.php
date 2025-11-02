<!DOCTYPE html>
<html lang="en">
  <head>
  <base href="/public">
    @include('admin.css')
    <style>
      .order-table th {
        font-weight: 600;
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
            @if(session()->has('message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            @if(session()->has('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h4 class="card-title mb-0">All Orders</h4>
                      <a href="{{ route('orders.export.pdf') }}" class="btn btn-danger">
                        <i class="mdi mdi-file-pdf"></i> Export to PDF
                      </a>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover order-table">
                        <thead>
                          <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Total</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($orders as $order)
                          <tr>
                            <td>#{{ $order->id }}</td>
                            <td>
                              {{ $order->first_name }} {{ $order->last_name }}
                              <br>
                              <small class="text-muted">{{ $order->email }}</small>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                              @if($order->status == 'completed')
                                <span class="badge badge-success">Paid</span>
                              @elseif($order->status == 'processing')
                                <span class="badge badge-primary">Processing</span>
                              @elseif($order->status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                              @else
                                <span class="badge badge-warning">Cash on delivery</span>
                              @endif
                            </td>
                            <td>
                              @if($order->delivery_status == 'delivered')
                                <span class="badge badge-success">Delivered</span>
                              @elseif($order->delivery_status == 'shipped')
                                <span class="badge badge-info">Shipped</span>
                              @elseif($order->delivery_status == 'processing')
                                <span class="badge badge-primary">Processing</span>
                              @elseif($order->delivery_status == 'cancelled')
                                <span class="badge badge-danger">Cancelled</span>
                              @else
                                <span class="badge badge-warning">Pending</span>
                              @endif
                            </td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>
                              <div class="d-flex">
                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-sm btn-primary mr-1" title="View Order">
                                  <i class="mdi mdi-eye"></i>
                                </a>
                                @if($order->delivery_status != 'delivered' && $order->status != 'cancelled')
                                  <form action="{{ route('order.update-status', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="status" value="delivered">
                                    <button type="submit" class="btn btn-sm btn-success" title="Mark as Delivered" onclick="return confirm('Are you sure you want to mark this order as delivered?')">
                                      <i class="mdi mdi-truck-delivery"></i>
                                    </button>
                                  </form>
                                @endif
                              </div>
                            </td>
                          </tr>
                          @empty
                          <tr>
                            <td colspan="6" class="text-center">No orders found</td>
                          </tr>
                          @endforelse
                        </tbody>
                      </table>
                    </div>
                    
                    @if($orders->hasPages())
                    <div class="mt-4">
                      {{ $orders->links() }}
                    </div>
                    @endif
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
