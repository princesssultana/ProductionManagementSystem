@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Packaging Materials</h3>

    <a href="{{ route('materials.create') }}" class="btn btn-primary mb-3">Add Packaging Material</a>

    @if($materials->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Unit</th>
                    <th>Supplier</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materials as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->supplier ?? 'N/A' }}</td>
                    <td>
                        <td>{{ $item->status }}</td>
                    </td>
                    <td>
                        <a href="{{ route('materials.show', $item->id) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('materials.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('materials.destroy', $item->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info">No Packaging Materials Found.</div>
    @endif
</div>
@endsection
