@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Employees</h1>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Job Title</th>
                        <th>Office</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr>
                            <td>{{ $employee->employeeNumber }}</td>
                            <td><strong>{{ $employee->firstName }} {{ $employee->lastName }}</strong></td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->jobTitle }}</td>
                            <td>{{ $employee->office->city ?? '-' }}</td>
                            <td>{{ $employee->phone ?? '-' }}</td>
                            <td>
                                <a href="{{ route('employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No employees found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $employees->links() }}
        </div>
    </div>
@endsection