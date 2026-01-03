@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Order #{{ $order->orderNumber }}</h1>
            <p class="text-muted">Customer: {{ $order->customer->customerName }}</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('orders.pdf', $order) }}" class="btn btn-primary" target="_blank">
                <i class="bi bi-file-pdf"></i> Download PDF
            </a>
            <a href="{{ route('customers.orders', $order->customer) }}" class="btn btn-secondary">Back to Orders</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Order Information</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Order Date:</label>
                            <p>{{ $order->orderDate ? \Carbon\Carbon::parse($order->orderDate)->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status:</label>
                            <p>
                                @if($order->status === 'Shipped')
                                <span class="badge bg-success">{{ $order->status }}</span>
                                @elseif($order->status === 'Pending')
                                <span class="badge bg-warning">{{ $order->status }}</span>
                                @elseif($order->status === 'Cancelled')
                                <span class="badge bg-danger">{{ $order->status }}</span>
                                @else
                                <span class="badge bg-info">{{ $order->status }}</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Required Date:</label>
                            <p>{{ $order->requiredDate ? \Carbon\Carbon::parse($order->requiredDate)->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Shipped Date:</label>
                            <p>{{ $order->shippedDate ? \Carbon\Carbon::parse($order->shippedDate)->format('M d, Y') : 'N/A' }}
                            </p>
                        </div>
                    </div>

                    @if($order->comments)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Comments:</label>
                        <p>{{ $order->comments }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Items</h5>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
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
                                    <td><code>{{ $detail->productCode }}</code></td>
                                    <td>{{ $detail->product->productName ?? 'N/A' }}</td>
                                    <td>{{ $detail->quantityOrdered }}</td>
                                    <td>${{ number_format($detail->priceEach ?? 0, 2) }}</td>
                                    <td><strong>${{ number_format(($detail->quantityOrdered ?? 0) * ($detail->priceEach ?? 0), 2) }}</strong>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">No items in this order.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($order->orderDetails->count() > 0)
                    <div class="text-end mt-3">
                        <h6>Order Total:
                            <strong>${{ number_format($order->orderDetails->sum(function ($detail) {
                            return ($detail->quantityOrdered ?? 0) * ($detail->priceEach ?? 0); }), 2) }}</strong>
                        </h6>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Information</h5>

                    <p class="mb-2">
                        <label class="fw-bold">Name:</label><br>
                        {{ $order->customer->customerName }}
                    </p>

                    <p class="mb-2">
                        <label class="fw-bold">Contact:</label><br>
                        {{ $order->customer->contactFirstName }} {{ $order->customer->contactLastName }}
                    </p>

                    <p class="mb-2">
                        <label class="fw-bold">Phone:</label><br>
                        {{ $order->customer->phone ?? 'N/A' }}
                    </p>

                    <p class="mb-2">
                        <label class="fw-bold">Address:</label><br>
                        {{ $order->customer->addressLine1 }}<br>
                        @if($order->customer->addressLine2)
                        {{ $order->customer->addressLine2 }}<br>
                        @endif
                        {{ $order->customer->city }}, {{ $order->customer->state }}
                        {{ $order->customer->postalCode }}<br>
                        {{ $order->customer->country }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
