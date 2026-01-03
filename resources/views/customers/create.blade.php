@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Create New Customer</h1>
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
                        <form action="{{ route('customers.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="customerName" class="form-label">Customer Name *</label>
                                <input type="text" class="form-control @error('customerName') is-invalid @enderror"
                                    id="customerName" name="customerName" value="{{ old('customerName') }}" required>
                                @error('customerName')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contactFirstName" class="form-label">Contact First Name</label>
                                        <input type="text"
                                            class="form-control @error('contactFirstName') is-invalid @enderror"
                                            id="contactFirstName" name="contactFirstName"
                                            value="{{ old('contactFirstName') }}">
                                        @error('contactFirstName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="contactLastName" class="form-label">Contact Last Name</label>
                                        <input type="text"
                                            class="form-control @error('contactLastName') is-invalid @enderror"
                                            id="contactLastName" name="contactLastName"
                                            value="{{ old('contactLastName') }}">
                                        @error('contactLastName')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="addressLine1" class="form-label">Address Line 1</label>
                                <input type="text" class="form-control @error('addressLine1') is-invalid @enderror"
                                    id="addressLine1" name="addressLine1" value="{{ old('addressLine1') }}">
                                @error('addressLine1')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="addressLine2" class="form-label">Address Line 2</label>
                                <input type="text" class="form-control @error('addressLine2') is-invalid @enderror"
                                    id="addressLine2" name="addressLine2" value="{{ old('addressLine2') }}">
                                @error('addressLine2')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                            id="city" name="city" value="{{ old('city') }}">
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" class="form-control @error('state') is-invalid @enderror"
                                            id="state" name="state" value="{{ old('state') }}">
                                        @error('state')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="postalCode" class="form-label">Postal Code</label>
                                        <input type="text" class="form-control @error('postalCode') is-invalid @enderror"
                                            id="postalCode" name="postalCode" value="{{ old('postalCode') }}">
                                        @error('postalCode')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                            id="country" name="country" value="{{ old('country') }}">
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="creditLimit" class="form-label">Credit Limit</label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control @error('creditLimit') is-invalid @enderror" id="creditLimit"
                                    name="creditLimit" value="{{ old('creditLimit') }}">
                                @error('creditLimit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">Create Customer</button>
                                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
