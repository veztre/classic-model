@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>{{ $product->productName }}</h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Details</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Code:</label>
                            <p><code>{{ $product->productCode }}</code></p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Name:</label>
                            <p>{{ $product->productName }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Line:</label>
                            <p>{{ $product->productLine ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Scale:</label>
                            <p>{{ $product->productScale ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Product Vendor:</label>
                            <p>{{ $product->productVendor ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Quantity in Stock:</label>
                            <p>{{ $product->quantityInStock ?? 0 }}</p>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Buy Price:</label>
                            <p>${{ number_format($product->buyPrice ?? 0, 2) }}</p>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">MSRP:</label>
                            <p>${{ number_format($product->MSRP ?? 0, 2) }}</p>
                        </div>
                    </div>

                    @if($product->productDescription)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Description:</label>
                        <p>{{ $product->productDescription }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection