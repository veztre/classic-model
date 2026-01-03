@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Orders for {{ $customer->customerName }}</h1>
            <p class="text-muted">Customer #{{ $customer->customerNumber }}</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('customers.show', $customer) }}" class="btn btn-secondary">Back to Customer</a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Order #</th>
                    <th>Order Date</th>
                    <th>Required Date</th>
                    <th>Shipped Date</th>
                    <th>Status</th>
                    <th>Items</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr>
                    <td><strong>#{{ $order->orderNumber }}</strong></td>
                    <td>{{ $order->orderDate ? \Carbon\Carbon::parse($order->orderDate)->format('M d, Y') : '-' }}</td>
                    <td>{{ $order->requiredDate ? \Carbon\Carbon::parse($order->requiredDate)->format('M d, Y') : '-' }}
                    </td>
                    <td>{{ $order->shippedDate ? \Carbon\Carbon::parse($order->shippedDate)->format('M d, Y') : '-' }}
                    </td>
                    <td>
                        @if($order->status === 'Shipped')
                        <span class="badge bg-success">{{ $order->status }}</span>
                        @elseif($order->status === 'Pending')
                        <span class="badge bg-warning">{{ $order->status }}</span>
                        @elseif($order->status === 'Cancelled')
                        <span class="badge bg-danger">{{ $order->status }}</span>
                        @else
                        <span class="badge bg-info">{{ $order->status }}</span>
                        @endif
                    </td>
                    <td>{{ $order->orderDetails->count() }}</td>
                    <td>
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-info">View Details</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No orders found for this customer.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="justify-content-center">
        {{ $orders->links() }}
    </div>
</div>
@endsection