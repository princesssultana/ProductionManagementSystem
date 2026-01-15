@extends('master')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Packaging Material Details
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Material Name</th>
                    <td>{{ $material->name }}</td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td>{{ $material->type }}</td>
                </tr>
                <tr>
                    <th>Unit</th>
                    <td>{{ $material->unit }}</td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td>{{ $material->supplier ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Minimum Stock</th>
                    <td>{{ $material->min_stock ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>{{ $material->price ? number_format($material->price,2) : 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $material->status == 'active' ? 'success' : 'secondary' }}">
                            {{ ucfirst($material->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $material->created_at?->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Last Updated</th>
                    <td>{{ $material->updated_at?->format('d M Y') }}</td>
                </tr>
            </table>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('materials.edit', $material->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
