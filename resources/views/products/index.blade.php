@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Products</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.create') }}" class="btn btn-primary">+ New Product</a>
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
                    <th>Code</th>
                    <th>Name</th>
                    <th>Line</th>
                    <th>Vendor</th>
                    <th>Stock</th>
                    <th>Buy Price</th>
                    <th>MSRP</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td><code>{{ $product->productCode }}</code></td>
                    <td><strong>{{ $product->productName }}</strong></td>
                    <td>{{ $product->productLine ?? '-' }}</td>
                    <td>{{ $product->productVendor ?? '-' }}</td>
                    <td>{{ $product->quantityInStock ?? 0 }}</td>
                    <td>${{ number_format($product->buyPrice ?? 0, 2) }}</td>
                    <td>${{ number_format($product->MSRP ?? 0, 2) }}</td>
                    <td>
                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="justify-content-center">
        {{ $products->links() }}
    </div>
</div>
@endsection