@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">Process Production Order #{{ $demand->id }}</h3>
                </div>
                <div class="card-body">
                    {{-- Display Demand Items --}}
                    <h5 class="mb-3">Order Items</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-striped table-bordered table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Quantity Requested</th>
                                    <th>Current Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demand->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td><span class="badge bg-info">{{ $item->quantity }}</span></td>
                                        <td>
                                            <span class="badge {{ $item->product->stock >= $item->quantity ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->product->stock }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->product->stock >= $item->quantity)
                                                <span class="badge bg-success">Sufficient</span>
                                            @else
                                                <span class="badge bg-danger">Insufficient</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No items</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <form action="{{ route('demands.update', $demand->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label class="form-label">Order Note</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $demand->name) }}">
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Pending" {{ $demand->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Approved" {{ $demand->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                                <option value="Rejected" {{ $demand->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <div class="alert alert-info">
                            <strong>Note:</strong> When you approve this production order, all requested quantities will be deducted from the current stock automatically.
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Process Production Order</button>
                            <a href="{{ route('demands.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

