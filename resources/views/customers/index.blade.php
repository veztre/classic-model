@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Customers</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('customers.create') }}" class="btn btn-primary">+ New Customer</a>
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
                        <th>ID</th>
                        <th>Name</th>
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
                                <a href="{{ route('customers.orders', $customer) }}" class="btn btn-sm btn-secondary">Orders</a>
                                <a href="{{ route('customers.edit', $customer) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No customers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="justify-content-center mt-3 ">
            {{ $customers->links() }}
        </div>
    </div>
@endsection