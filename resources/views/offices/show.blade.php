@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>{{ $office->city }} Office</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('offices.edit', $office) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('offices.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Office Details</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Office Code:</label>
                                <p><code>{{ $office->officeCode }}</code></p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">City:</label>
                                <p>{{ $office->city }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Phone:</label>
                                <p>{{ $office->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Territory:</label>
                                <p>{{ $office->territory ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Country:</label>
                                <p>{{ $office->country }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">State:</label>
                                <p>{{ $office->state ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Postal Code:</label>
                                <p>{{ $office->postalCode ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Address Line 1:</label>
                            <p>{{ $office->addressLine1 }}</p>
                        </div>

                        @if($office->addressLine2)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Address Line 2:</label>
                                <p>{{ $office->addressLine2 }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection