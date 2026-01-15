@extends('master')

@section('content')

<div class="container mt-4">
    <h3>All Demands</h3>

    <a href="{{ route('demands.create') }}" class="btn btn-primary mb-3">
        Add Demand
    </a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Material</th>
                <th>Demand Note</th>
                <th>Qty</th>
                <th>Approved Qty</th>
                <th>Status</th>
                <th>Date Approved</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            @forelse($demands as $demand)
                <tr class="{{ strtolower($demand->status) === 'pending' ? 'table-warning' : '' }}">
                    <td>{{ $demand->id }}</td>

                    {{-- Material --}}
                    <td>
                        {{ $demand->material->name ?? 'N/A' }}
                        <br>
                        <small class="text-muted">
                            Stock: {{ $demand->material->stock ?? 0 }}
                        </small>
                    </td>

                    {{-- Demand Note --}}
                    <td>{{ $demand->name ?: '-' }}</td>

                    <td>{{ $demand->qty }}</td>
                    <td>{{ $demand->approved_qty ?? '-' }}</td>

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

                    <td>{{ $demand->date_approved ?? '-' }}</td>

                    {{-- Actions --}}
                    <td>
                        <a href="{{ route('demands.show', $demand->id) }}" class="btn btn-info btn-sm">
                            Details
                        </a>

                        {{-- Show Approve/Edit button only if status is Pending --}}
                        @if(strtolower($demand->status) == 'pending')
                            <a href="{{ route('demands.edit', $demand->id) }}" class="btn btn-warning btn-sm">
                                Approve
                            </a>
                        @endif

                        <form action="{{ route('demands.destroy', $demand->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No demands found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
