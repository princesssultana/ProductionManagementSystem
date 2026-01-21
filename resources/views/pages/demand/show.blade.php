@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Production Order #{{ $demand->id }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><h6>Order Note</h6></div>
                        <div class="col-sm-9 text-secondary">{{ $demand->name ?? '-' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3"><h6>Status</h6></div>
                        <div class="col-sm-9">
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
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3"><h6>Order Date</h6></div>
                        <div class="col-sm-9 text-secondary">{{ $demand->date_requested ?? '-' }}</div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3"><h6>Approval Date</h6></div>
                        <div class="col-sm-9 text-secondary">{{ $demand->date_approved ?? '-' }}</div>
                    </div>

                    <hr>

                    <h5 class="mb-3">Medicines for Production</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Stock Available</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($demand->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                                        <td><span class="badge bg-info">{{ $item->quantity }}</span></td>
                                        <td>
                                            <span class="badge {{ $item->product->stock >= $item->quantity ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->product->stock }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No items in this production order</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Packing Materials Summary --}}
                    @php
                        $hasMaterials = false;
                        foreach($demand->items as $item) {
                            if($item->product->packagingMaterials->count() > 0) {
                                $hasMaterials = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasMaterials)
                    <hr>
                    <h5 class="mb-3">Required Packaging Materials</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Medicine</th>
                                    <th>Material Name</th>
                                    <th>Qty Per Unit</th>
                                    <th>Demanded Qty</th>
                                    <th>Total Material Needed</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demand->items as $item)
                                    @foreach($item->product->packagingMaterials as $material)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $material->name ?? 'Material ' . $material->id }}</td>
                                            <td>{{ $material->pivot->quantity_per_unit }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>
                                                <strong>{{ $material->pivot->quantity_per_unit * $item->quantity }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('demands.index') }}" class="btn btn-secondary">Back to Production Orders</a>
                    @if(strtolower($demand->status) == 'pending')
                        <a href="{{ route('demands.edit', $demand->id) }}" class="btn btn-warning">Approve/Process Order</a>
                    @endif
                    <form action="{{ route('demands.destroy', $demand->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
