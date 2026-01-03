@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1>Employee Dashboard</h1>
            <p class="text-muted">Welcome, {{ $employee->firstName }} {{ $employee->lastName }}</p>
        </div>
        <div class="col-md-4 text-end">
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-outline-danger">Logout</button>
            </form>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Total Customers</h5>
                    <h2 class="text-primary">{{ $customers->total() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Job Title</h5>
                    <p>{{ $employee->jobTitle }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Office</h5>
                    <p>{{ $employee->office->city ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title">Email</h5>
                    <p>{{ $employee->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>My Assigned Customers</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Contact</th>
                            <th>City</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Credit Limit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $customer)
                        <tr>
                            <td>{{ $customer->customerNumber }}</td>
                            <td><strong>{{ $customer->customerName }}</strong></td>
                            <td>{{ $customer->contactFirstName }} {{ $customer->contactLastName }}</td>
                            <td>{{ $customer->city }}</td>
                            <td>{{ $customer->country }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>${{ number_format($customer->creditLimit ?? 0, 2) }}</td>
                            <td>
                                <a href="{{ route('customers.show', $customer) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('customers.orders', $customer) }}"
                                    class="btn btn-sm btn-secondary">Orders</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No customers assigned yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>
@endsection