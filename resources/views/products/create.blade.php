@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Create New Product</h1>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Errors:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="productCode" class="form-label">Product Code *</label>
                                <input type="text" class="form-control @error('productCode') is-invalid @enderror"
                                    id="productCode" name="productCode" value="{{ old('productCode') }}" required>
                                @error('productCode')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productName" class="form-label">Product Name *</label>
                                <input type="text" class="form-control @error('productName') is-invalid @enderror"
                                    id="productName" name="productName" value="{{ old('productName') }}" required>
                                @error('productName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="productLine" class="form-label">Product Line</label>
                                        <select class="form-control @error('productLine') is-invalid @enderror"
                                            id="productLine" name="productLine">
                                            <option value="">-- Select Product Line --</option>
                                            @foreach($productLines as $line)
                                                <option value="{{ $line->productLine }}" {{ old('productLine') == $line->productLine ? 'selected' : '' }}>
                                                    {{ $line->productLine }}</option>
                                            @endforeach
                                        </select>
                                        @error('productLine')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="productScale" class="form-label">Product Scale</label>
                                        <input type="text" class="form-control @error('productScale') is-invalid @enderror"
                                            id="productScale" name="productScale" value="{{ old('productScale') }}"
                                            placeholder="e.g., 1:10">
                                        @error('productScale')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="productVendor" class="form-label">Product Vendor</label>
                                <input type="text" class="form-control @error('productVendor') is-invalid @enderror"
                                    id="productVendor" name="productVendor" value="{{ old('productVendor') }}">
                                @error('productVendor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="productDescription" class="form-label">Product Description</label>
                                <textarea class="form-control @error('productDescription') is-invalid @enderror"
                                    id="productDescription" name="productDescription"
                                    rows="4">{{ old('productDescription') }}</textarea>
                                @error('productDescription')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="quantityInStock" class="form-label">Quantity in Stock</label>
                                        <input type="number" min="0"
                                            class="form-control @error('quantityInStock') is-invalid @enderror"
                                            id="quantityInStock" name="quantityInStock"
                                            value="{{ old('quantityInStock') }}">
                                        @error('quantityInStock')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="buyPrice" class="form-label">Buy Price</label>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control @error('buyPrice') is-invalid @enderror" id="buyPrice"
                                            name="buyPrice" value="{{ old('buyPrice') }}">
                                        @error('buyPrice')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="MSRP" class="form-label">MSRP</label>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control @error('MSRP') is-invalid @enderror" id="MSRP" name="MSRP"
                                            value="{{ old('MSRP') }}">
                                        @error('MSRP')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Create Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection