@extends('master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🏭 Factory Settings</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('factories.create') }}" class="btn btn-success mb-3">
        + Add Factory
    </a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Factory Name</th>
                <th>Max Capacity</th>
                <th>Min Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($factories as $key => $factory)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $factory->factory_name }}</td>
                    <td>{{ $factory->max_capacity }}</td>
                    <td>{{ $factory->min_stock_threshold }}</td>
                    <td>
                        <span class="badge bg-{{ $factory->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($factory->status) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No factories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
