@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1>Offices</h1>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('offices.create') }}" class="btn btn-primary">+ New Office</a>
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
                        <th>City</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Country</th>
                        <th>Territory</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($offices as $office)
                        <tr>
                            <td><code>{{ $office->officeCode }}</code></td>
                            <td><strong>{{ $office->city }}</strong></td>
                            <td>{{ $office->phone }}</td>
                            <td>{{ $office->addressLine1 }}</td>
                            <td>{{ $office->country }}</td>
                            <td>{{ $office->territory ?? '-' }}</td>
                            <td>
                                <a href="{{ route('offices.show', $office) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('offices.edit', $office) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('offices.destroy', $office) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No offices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="justify-content-center">
            {{ $offices->links() }}
        </div>
    </div>
@endsection