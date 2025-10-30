@extends('admin.layouts.master')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Order #{{ $order->id }}</h4>
                        <div>
                            <span class="badge 
                                @if($order->status == 'completed') badge-success 
                                @elseif($order->status == 'processing') badge-info 
                                @elseif($order->status == 'cancelled') badge-danger 
                                @elseif($order->status == 'shipped') badge-warning 
                                @else badge-secondary @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                            @if($order->payment_id)
                                <span class="badge badge-success ml-2">Paid</span>
                            @else
                                <span class="badge badge-warning ml-2">Cash on Delivery</span>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5>Order Details</h5>
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                            <p><strong>Payment Method:</strong> {{ $order->payment_id ? 'Credit Card' : 'Cash on Delivery' }}</p>
                            
                            <h5 class="mt-4">Customer Information</h5>
                            <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                            <p><strong>Email:</strong> {{ $order->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Shipping Address</h5>
                            <p>
                                {{ $order->address }}<br>
                                {{ $order->city }}, {{ $order->state }}<br>
                                {{ $order->zip_code }}<br>
                                {{ $order->country }}
                            </p>

                            @if($order->notes)
                                <h5 class="mt-4">Order Notes</h5>
                                <p>{{ $order->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="table-responsive mt-4">
                        <h5>Order Items</h5>
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
                                        {{ $item->product_name }}
                                        @if($item->product)
                                            <br><small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                        @endif
                                    </td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Subtotal:</strong></td>
                                    <td>${{ number_format($order->subtotal, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Tax ({{ config('cart.tax') }}%):</strong></td>
                                    <td>${{ number_format($order->tax, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Shipping:</strong></td>
                                    <td>${{ number_format($order->shipping, 2) }}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                    <td><strong>${{ number_format($order->total, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <h5>Update Order Status</h5>
                        <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="form-inline">
                            @csrf
                            <div class="form-group mr-2">
                                <select name="status" class="form-control">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Status</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
