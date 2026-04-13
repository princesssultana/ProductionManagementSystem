@extends('master')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Production Orders</h2>

    <a href="{{ route('demands.create') }}" class="btn btn-primary mb-3">
        + Create Production Order
    </a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Order Note</th>
                    <th>Medicines</th>
                    <th>Total Quantity</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Approved Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($demands as $demand)
                    <tr class="{{ strtolower($demand->status) === 'pending' ? 'table-warning' : '' }}">
                        <td>
                            <strong>#{{ $demand->id }}</strong>
                        </td>

                        {{-- Demand Note --}}
                        <td>
                            {{ $demand->name ?: '-' }}
                        </td>

                        {{-- Products --}}
                        <td>
                            @if($demand->items->count() > 0)
                                <ul class="mb-0" style="font-size: 0.9rem;">
                                    @foreach($demand->items as $item)
                                        <li>
                                            {{ $item->product->name }}
                                            <span class="badge bg-secondary">{{ $item->quantity }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No items</span>
                            @endif
                        </td>

                        {{-- Total Items --}}
                        <td>
                            <span class="badge bg-info">{{ $demand->items->sum('quantity') }}</span>
                        </td>

                        {{-- Status Badge --}}
                        <td>
                            @switch(strtolower($demand->status))
                                @case('approved')
                                    <span class="badge bg-success">Approved</span>
                                    @break

                                @case('rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                    @break

                                @default
                                    <span class="badge bg-warning text-dark">Pending</span>
                            @endswitch
                        </td>

                        <td>{{ $demand->date_requested ?? '-' }}</td>

                        <td>{{ $demand->date_approved ?? '-' }}</td>

                        <td>
                            <a href="{{ route('demands.show', $demand->id) }}" class="btn btn-info btn-sm">
                                View
                            </a>

                            <a href="{{ route('demands.materials', $demand->id) }}" class="btn btn-secondary btn-sm" title="View Packing Materials">
                                <i class="bi bi-box"></i> Materials
                            </a>

                            {{-- Show Approve/Edit button only if status is Pending --}}
                            @if(strtolower($demand->status) == 'pending')
                                <a href="{{ route('demands.edit', $demand->id) }}" class="btn btn-warning btn-sm" title="Approve Order">
                                    <i class="bi bi-check"></i> Approve
                                </a>
                            @endif

                            <form action="{{ route('demands.destroy', $demand->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" title="Delete">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            No demands found. <a href="{{ route('demands.create') }}">Create one now</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
