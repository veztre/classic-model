@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>{{ $employee->firstName }} {{ $employee->lastName }}</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('employees.index') }}" class="btn btn-secondary">Back to Employees</a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Employee Information</h5>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Employee Number:</label>
                                <p>{{ $employee->employeeNumber }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Job Title:</label>
                                <p>{{ $employee->jobTitle }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Email:</label>
                                <p>{{ $employee->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Extension:</label>
                                <p>{{ $employee->extension ?? 'N/A' }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Office:</label>
                                <p>{{ $employee->office->city ?? 'N/A' }} - {{ $employee->office->country ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Reports To:</label>
                                <p>
                                    @if($employee->manager)
                                        {{ $employee->manager->firstName }} {{ $employee->manager->lastName }}
                                    @else
                                        N/A (Senior Manager)
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5>Assigned Customers ({{ $customers->total() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Contact</th>
                                        <th>City</th>
                                        <th>Country</th>
                                        <th>Credit Limit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($customers as $customer)
                                        <tr>
                                            <td>{{ $customer->customerNumber }}</td>
                                            <td>{{ $customer->customerName }}</td>
                                            <td>{{ $customer->contactFirstName }} {{ $customer->contactLastName }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->country }}</td>
                                            <td>${{ number_format($customer->creditLimit ?? 0, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-3">No customers assigned.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            {{ $customers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection