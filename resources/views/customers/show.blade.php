@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>{{ $customer->customerName }}</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Customer Details</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Customer Number:</label>
                                <p>{{ $customer->customerNumber }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Customer Name:</label>
                                <p>{{ $customer->customerName }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Contact First Name:</label>
                                <p>{{ $customer->contactFirstName ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Contact Last Name:</label>
                                <p>{{ $customer->contactLastName ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone:</label>
                                <p>{{ $customer->phone ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email:</label>
                                <p>N/A</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Address Line 1:</label>
                                <p>{{ $customer->addressLine1 ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Address Line 2:</label>
                                <p>{{ $customer->addressLine2 ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">City:</label>
                                <p>{{ $customer->city ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">State:</label>
                                <p>{{ $customer->state ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Postal Code:</label>
                                <p>{{ $customer->postalCode ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Country:</label>
                                <p>{{ $customer->country ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Credit Limit:</label>
                                <p>${{ number_format($customer->creditLimit ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
