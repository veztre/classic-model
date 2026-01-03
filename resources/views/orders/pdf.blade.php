<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .info-block {
            flex: 1;
            margin-right: 20px;
        }

        .info-block label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .info-block p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #f5f5f5;
            border-bottom: 2px solid #333;
        }

        th {
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .total-row {
            font-weight: bold;
            text-align: right;
        }

        .footer {
            margin-top: 40px;
            border-top: 2px solid #333;
            padding-top: 20px;
            text-align: center;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Order #{{ $order->orderNumber }}</h1>
        <p>Customer: {{ $order->customer->customerName }}</p>
        <p>Generated on: {{ now()->format('M d, Y H:i') }}</p>
    </div>

    <div class="order-info">
        <div class="info-block">
            <label>Order Date:</label>
            <p>{{ $order->orderDate ? \Carbon\Carbon::parse($order->orderDate)->format('M d, Y') : 'N/A' }}</p>

            <label>Required Date:</label>
            <p>{{ $order->requiredDate ? \Carbon\Carbon::parse($order->requiredDate)->format('M d, Y') : 'N/A' }}</p>

            <label>Status:</label>
            <p>{{ $order->status ?? 'N/A' }}</p>
        </div>

        <div class="info-block">
            <label>Shipped Date:</label>
            <p>{{ $order->shippedDate ? \Carbon\Carbon::parse($order->shippedDate)->format('M d, Y') : 'N/A' }}</p>

            <label>Contact Person:</label>
            <p>{{ $order->customer->contactFirstName }} {{ $order->customer->contactLastName }}</p>

            <label>Phone:</label>
            <p>{{ $order->customer->phone ?? 'N/A' }}</p>
        </div>
    </div>

    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($order->orderDetails as $detail)
                <tr>
                    <td>{{ $detail->productCode }}</td>
                    <td>{{ $detail->product->productName ?? 'N/A' }}</td>
                    <td>{{ $detail->quantityOrdered }}</td>
                    <td>${{ number_format($detail->priceEach ?? 0, 2) }}</td>
                    <td>${{ number_format(($detail->quantityOrdered ?? 0) * ($detail->priceEach ?? 0), 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">No items in this order.</td>
                </tr>
            @endforelse
        </tbody>
        @if($order->orderDetails->count() > 0)
                <tfoot>
                    <tr class="total-row">
                        <td colspan="4">Order Total:</td>
                        <td>${{ number_format($order->orderDetails->sum(function ($detail) {
                return ($detail->quantityOrdered ?? 0) * ($detail->priceEach ?? 0);
            }), 2) }}</td>
                    </tr>
                </tfoot>
        @endif
    </table>

    @if($order->comments)
        <h3>Comments</h3>
        <p>{{ $order->comments }}</p>
    @endif

    <div class="footer">
        <p>This is an automatically generated order document.</p>
    </div>
</body>

</html>