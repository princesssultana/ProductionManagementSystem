@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Required Packaging Materials - Production Order #{{ $demand->id }}</h3>
                </div>
                <div class="card-body">
                    <!-- Production Order Summary -->
                    <div class="alert alert-info mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Order Note:</strong> {{ $demand->name ?? '-' }}
                            </div>
                            <div class="col-md-3">
                                <strong>Status:</strong>
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
                            <div class="col-md-3">
                                <strong>Total Medicines:</strong> {{ $demand->items->count() }}
                            </div>
                            <div class="col-md-3">
                                <strong>Total Qty:</strong> <span class="badge bg-primary">{{ $demand->items->sum('quantity') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Products and Materials Section -->
                    @forelse($demand->items as $item)
                        <div class="card mb-4 border-left border-primary" style="border-left-width: 4px;">
                            <div class="card-header bg-light">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <h5 class="mb-0">{{ $item->product->name }}</h5>
                                        <small class="text-muted">Category: {{ $item->product->category->name ?? 'N/A' }}</small>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <span class="badge bg-info">Qty: {{ $item->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($item->product->packagingMaterials->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Material Name</th>
                                                    <th class="text-center">Qty Per Unit</th>
                                                    <th class="text-center">Demanded Qty</th>
                                                    <th class="text-center">Total Material Needed</th>
                                                    <th class="text-center">Unit Price</th>
                                                    <th class="text-center">Total Cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($item->product->packagingMaterials as $material)
                                                    @php
                                                        $totalNeeded = $material->pivot->quantity_per_unit * $item->quantity;
                                                        $totalCost = $totalNeeded * $material->price;
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $material->name ?? 'Material ' . $material->id }}</strong>
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $material->pivot->quantity_per_unit }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ $item->quantity }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-success" style="font-size: 1rem;">
                                                                {{ $totalNeeded }}
                                                            </span>
                                                        </td>
                                                        <td class="text-center">
                                                            ৳{{ number_format($material->price, 2) }}
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge bg-primary" style="font-size: 1rem;">
                                                                ৳{{ number_format($totalCost, 2) }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="alert alert-warning mb-0">
                                        No packing materials assigned to this product.
                                    </div>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            This demand has no items.
                        </div>
                    @endforelse

                    <!-- Total Summary -->
                    @php
                        $allMaterials = [];
                        foreach($demand->items as $item) {
                            foreach($item->product->packagingMaterials as $material) {
                                $key = $material->id;
                                if (!isset($allMaterials[$key])) {
                                    $allMaterials[$key] = [
                                        'name' => $material->name,
                                        'total' => 0
                                    ];
                                }
                                $allMaterials[$key]['total'] += $material->pivot->quantity_per_unit * $item->quantity;
                            }
                        }
                    @endphp

                    @if(count($allMaterials) > 0)
                    <div class="card border-success mt-4">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">Overall Materials Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Material Name</th>
                                            <th class="text-center">Total Quantity Needed</th>
                                            <th class="text-center">Unit Price</th>
                                            <th class="text-center">Total Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $totalCostAll = 0; @endphp
                                        @foreach($allMaterials as $material)
                                            @php 
                                                $materialPrice = 0;
                                                foreach($demand->items as $item) {
                                                    foreach($item->product->packagingMaterials as $m) {
                                                        if($m->id == $material['id']) {
                                                            $materialPrice = $m->price;
                                                            break;
                                                        }
                                                    }
                                                    if($materialPrice > 0) break;
                                                }
                                                $subtotal = $material['total'] * $materialPrice;
                                                $totalCostAll += $subtotal;
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $material['name'] }}</strong>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $material['total'] }}</span>
                                                </td>
                                                <td class="text-center">
                                                    ৳{{ number_format($materialPrice, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-primary" style="font-size: 1rem;">
                                                        ৳{{ number_format($subtotal, 2) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="table-success" style="font-weight: bold; font-size: 1.1rem;">
                                            <td colspan="2"></td>
                                            <td class="text-center">TOTAL COST:</td>
                                            <td class="text-center">
                                                <span class="badge bg-success" style="font-size: 1.1rem; padding: 10px 15px;">
                                                    ৳{{ number_format($totalCostAll, 2) }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="card-footer">
                    <a href="{{ route('demands.show', $demand->id) }}" class="btn btn-info">View Demand Details</a>
                    <a href="{{ route('demands.index') }}" class="btn btn-secondary">Back to Demands</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
