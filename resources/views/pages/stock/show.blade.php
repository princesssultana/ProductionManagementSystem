@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Stock Details</h3>

    <table class="table table-bordered">
        <tr>
            <th>Item Name</th>
            <td>{{ $stock->stockable->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Type</th>
            <td>{{ class_basename($stock->stockable_type) }}</td>
        </tr>
        <tr>
            <th>Quantity</th>
            <td>{{ $stock->quantity }}</td>
        </tr>
        <tr>
            <th>Batch No</th>
            <td>{{ $stock->batch_no }}</td>
        </tr>
        <tr>
            <th>Expiry Date</th>
            <td>{{ $stock->expiry_date->format('d M Y') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($stock->status) }}</td>
        </tr>
    </table>

    <h5>Related Demands</h5>
    @if($stock->demands->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Factory</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stock->demands as $demand)
            <tr>
                <td>{{ $demand->factory->name ?? 'N/A' }}</td>
                <td>{{ $demand->quantity }}</td>
                <td>{{ ucfirst($demand->status) }}</td>
                <td>{{ $demand->created_at->format('d M Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>No demands for this stock.</p>
    @endif

    <a href="{{ route('stocks.index') }}" class="btn btn-secondary mt-3">Back to Stock List</a>
</div>
@endsection
