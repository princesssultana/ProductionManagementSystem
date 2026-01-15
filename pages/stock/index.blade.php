@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Stock List</h3>

    <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Add Stock</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($stocks->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Batch No</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                    <th>Factory / Demand</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stocks as $index => $stock)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $stock->stockable->name ?? 'N/A' }}</td>
                    <td>
                        @if($stock->stockable_type == \App\Models\Medicine::class)
                            Medicine
                        @elseif($stock->stockable_type == \App\Models\PackagingMaterial::class)
                            Packaging Material
                        @endif
                    </td>
                    <td>{{ $stock->quantity }}</td>
                    <td>{{ $stock->batch_no }}</td>
                    <td>{{ \Carbon\Carbon::parse($stock->expiry_date)->format('d M Y') }}</td>
                    <td>
                        <span class="badge bg-{{ $stock->status == 'available' ? 'success' : 'secondary' }}">
                            {{ ucfirst($stock->status) }}
                        </span>
                    </td>
                    <td>
                        @php
                            $demand = $stock->demands()->latest()->first();
                        @endphp
                        @if($demand)
                            {{ $demand->factory->name ?? 'N/A' }} <br>
                            Qty: {{ $demand->quantity }} <br>
                            Status: {{ $demand->status }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('stocks.show', $stock->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this stock?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <div class="alert alert-info">No Stock Found.</div>
    @endif
</div>
@endsection
