@extends('master')

@section('content')

<div class="container mt-4">
    <h3>All Demands</h3>

    <a href="{{ route('demands.create') }}" class="btn btn-primary mb-3">Add Demand</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Approved Qty</th>
                <th>Status</th>
                <th>Date Approved</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($demands as $demand)
                <tr>
                    <td>{{ $demand->id }}</td>
                    <td>{{ $demand->name }}</td>
                    <td>{{ $demand->qty }}</td>
                    <td>{{ $demand->approved_qty ?? '-' }}</td>
                    <td>{{ $demand->status }}</td>
                    <td>{{ $demand->date_approved ?? '-' }}</td>
                    <td>
                        <a href="{{ route('demands.show', $demand->id) }}" class="btn btn-info btn-sm">Details</a>
                        <a href="{{ route('demands.edit', $demand->id) }}" class="btn btn-warning btn-sm">Edit/Approve</a>
                        <form action="{{ route('demands.destroy', $demand->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
