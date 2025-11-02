<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Order #{{ $order->id }} - {{ now()->format('Y-m-d') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }
        .header {
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #eee;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px solid #eee;
            color: #444;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }
        .col-6 {
            width: 50%;
            padding: 0 15px;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-primary {
            background-color: #cce5ff;
            color: #004085;
        }
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        .summary-table {
            width: 50%;
            margin-left: auto;
            margin-top: 20px;
        }
        .summary-table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        .summary-table tr:last-child {
            font-weight: bold;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Order #{{ $order->id }}</h1>
        <p>Order Date: {{ $order->created_at->format('F j, Y h:i A') }}</p>
        <p>Status: 
            @if($order->status == 'completed')
                <span class="badge badge-success">Paid</span>
            @elseif($order->status == 'processing')
                <span class="badge badge-primary">Processing</span>
            @elseif($order->status == 'cancelled')
                <span class="badge badge-danger">Cancelled</span>
            @else
                <span class="badge badge-warning">Pending</span>
            @endif
        </p>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="section">
                <div class="section-title">Customer Information</div>
                <p>
                    <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                    {{ $order->email }}<br>
                    {{ $order->phone ?? 'N/A' }}<br>
                </p>
            </div>
        </div>
        <div class="col-6">
            <div class="section">
                <div class="section-title">Shipping Address</div>
                <p>
                    {{ $order->first_name }} {{ $order->last_name }}<br>
                    {{ $order->address }}<br>
                    {{ $order->city }}, {{ $order->state }} {{ $order->postal_code }}<br>
                    {{ $order->country }}<br>
                    Phone: {{ $order->phone }}
                </p>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Order Items</div>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>
                        {{ $item->product->name ?? 'Product not found' }}
                        @if($item->product && $item->product->sku)
                            <br><small>SKU: {{ $item->product->sku }}</small>
                        @endif
                    </td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td class="text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="summary-table">
            <tr>
                <td>Subtotal:</td>
                <td class="text-right">${{ number_format($order->subtotal, 2) }}</td>
            </tr>
            @if($order->shipping > 0)
            <tr>
                <td>Shipping:</td>
                <td class="text-right">${{ number_format($order->shipping, 2) }}</td>
            </tr>
            @endif
            @if($order->tax > 0)
            <tr>
                <td>Tax:</td>
                <td class="text-right">${{ number_format($order->tax, 2) }}</td>
            </tr>
            @endif
            <tr>
                <td><strong>Total:</strong></td>
                <td class="text-right"><strong>${{ number_format($order->total, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Order Notes</div>
        <p>{{ $order->notes ?? 'No additional notes.' }}</p>
    </div>

    <div class="footer" style="margin-top: 50px; padding-top: 20px; border-top: 1px solid #eee; font-size: 10px; color: #777;">
        <p>Thank you for your order!<br>
        If you have any questions about your order, please contact our customer service.</p>
    </div>
</body>
</html>
