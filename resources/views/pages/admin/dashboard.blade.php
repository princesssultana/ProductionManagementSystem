@extends('master')

@section('content')
<div class="container-fluid mt-4 mb-5">
    {{-- Dashboard Header --}}
    <div class="mb-5">
        <h1 class="display-5 fw-bold text-dark mb-2">Production Dashboard</h1>
        <p class="text-muted">Welcome back! Here's your production system overview.</p>
    </div>

    {{-- Key Statistics Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-primary d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 15px;">
                        <i class="bi bi-capsule text-primary" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $totalMedicines }}</h3>
                    <p class="text-muted mb-0">Medicines</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-success  d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 15px;">
                        <i class="bi bi-tags text-success" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $totalCategories }}</h3>
                    <p class="text-muted mb-0">Categories</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-info  d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 15px;">
                        <i class="bi bi-clipboard-check text-info" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $totalProductionOrders }}</h3>
                    <p class="text-muted mb-0">Orders</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-warning  d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 15px;">
                        <i class="bi bi-box2 text-warning" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $totalPackagingMaterials }}</h3>
                    <p class="text-muted mb-0">Materials</p>
                </div>
            </div>
        </div>

        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <div class="rounded-circle bg-secondary  d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px; margin-bottom: 15px;">
                        <i class="bi bi-people text-secondary" style="font-size: 28px;"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $totalUsers }}</h3>
                    <p class="text-muted mb-0">Users</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Production Orders Status --}}
    <!-- <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title fw-bold mb-0">Approved Orders</h6>
                        <span class="badge bg-success rounded-pill">{{ $ordersApproved }}</span>
                    </div>
                    <h2 class="text-success fw-bold mb-3">{{ $ordersApproved }}</h2>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalProductionOrders > 0 ? ($ordersApproved / $totalProductionOrders * 100) : 0 }}%"></div>
                    </div>
                    <small class="text-muted">{{ $totalProductionOrders > 0 ? round(($ordersApproved / $totalProductionOrders * 100), 1) : 0 }}% of total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title fw-bold mb-0">Pending Orders</h6>
                        <span class="badge bg-warning rounded-pill">{{ $ordersPending }}</span>
                    </div>
                    <h2 class="text-warning fw-bold mb-3">{{ $ordersPending }}</h2>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: {{ $totalProductionOrders > 0 ? ($ordersPending / $totalProductionOrders * 100) : 0 }}%"></div>
                    </div>
                    <small class="text-muted">{{ $totalProductionOrders > 0 ? round(($ordersPending / $totalProductionOrders * 100), 1) : 0 }}% of total</small>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title fw-bold mb-0">Rejected Orders</h6>
                        <span class="badge bg-danger rounded-pill">{{ $ordersRejected }}</span>
                    </div>
                    <h2 class="text-danger fw-bold mb-3">{{ $ordersRejected }}</h2>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-danger" style="width: {{ $totalProductionOrders > 0 ? ($ordersRejected / $totalProductionOrders * 100) : 0 }}%"></div>
                    </div>
                    <small class="text-muted">{{ $totalProductionOrders > 0 ? round(($ordersRejected / $totalProductionOrders * 100), 1) : 0 }}% of total</small>
                </div>
            </div>
        </div>
    </div> -->

    {{-- Charts Row --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-4">Monthly Production Orders</h6>
                    <canvas id="monthlyOrdersChart" height="80"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-4">Medicines by Category</h6>
                    <canvas id="categoriesChart" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Low Stock Alert --}}
    @if($lowStockMedicines->count() > 0)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0 rounded-3 border-danger border-3">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 50px; height: 50px; margin-right: 15px;">
                            <i class="bi bi-exclamation-triangle text-danger" style="font-size: 24px;"></i>
                        </div>
                        <div>
                            <h6 class="card-title fw-bold mb-0">Low Stock Alert</h6>
                            <small class="text-muted">{{ $lowStockMedicines->count() }} medicine(s) below {{ $lowStockThreshold }} units</small>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Category</th>
                                    <th>Current Stock</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockMedicines as $medicine)
                                <tr>
                                    <td><strong>{{ $medicine->name }}</strong></td>
                                    <td>{{ $medicine->category->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $medicine->stock <= 10 ? 'bg-danger' : 'bg-warning' }} rounded-pill">
                                            {{ $medicine->stock }} units
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $medicine->status === 'active' ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                                            {{ ucfirst($medicine->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Recent Data --}}
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-4">Recent Production Orders</h6>
                    @if($recentOrders->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentOrders as $order)
                        <a href="{{ route('demands.show', $order->id) }}" class="list-group-item list-group-item-action px-0 py-3 border-bottom">
                            <div class="d-flex w-100 justify-content-between align-items-start">
                                <div>
                                    <strong class="mb-1">Order #{{ $order->id }}</strong>
                                    <div class="text-muted small">{{ $order->items->count() }} item(s) • Qty: {{ $order->items->sum('quantity') }}</div>
                                </div>
                                <span class="badge {{ $order->status === 'Approved' ? 'bg-success' : ($order->status === 'Pending' ? 'bg-warning' : 'bg-danger') }} rounded-pill">
                                    {{ $order->status }}
                                </span>
                            </div>
                            <div class="text-muted small mt-2">{{ $order->created_at->format('M d, Y H:i') }}</div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">No production orders yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-3 h-100">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-4">Recently Added Medicines</h6>
                    @if($recentMedicines->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($recentMedicines as $medicine)
                        <a href="{{ route('product.show', $medicine->id) }}" class="list-group-item list-group-item-action px-0 py-3 border-bottom">
                            <div class="d-flex w-100 justify-content-between align-items-start">
                                <div>
                                    <strong class="mb-1">{{ $medicine->name }}</strong>
                                    <div class="text-muted small">{{ $medicine->category->name ?? 'N/A' }}</div>
                                </div>
                                <span class="badge bg-info rounded-pill">Stock: {{ $medicine->stock }}</span>
                            </div>
                            <div class="text-muted small mt-2">{{ $medicine->created_at->format('M d, Y') }}</div>
                        </a>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">No medicines added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4"></script>

<script>
    // Monthly Production Orders Chart
    const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
    new Chart(monthlyOrdersCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_keys($monthlyOrders->toArray())) !!},
            datasets: [
                {
                    label: 'Orders',
                    data: {!! json_encode(array_values($monthlyOrders->toArray())) !!},
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#0d6efd',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                },
                {
                    label: 'Quantity',
                    data: {!! json_encode(array_values($monthlyDemandQty->toArray())) !!},
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#198754',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 11
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Medicines by Category Chart
    const categoriesCtx = document.getElementById('categoriesChart').getContext('2d');
    const categoryColors = ['#0d6efd', '#198754', '#ffc107', '#fd7e14', '#e74c3c', '#9b59b6', '#3498db', '#1abc9c'];
    new Chart(categoriesCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($medicinesByCategory->toArray())) !!},
            datasets: [{
                data: {!! json_encode(array_values($medicinesByCategory->toArray())) !!},
                backgroundColor: categoryColors.slice(0, {!! count($medicinesByCategory) !!}),
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            size: 11,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
</script>

@endsection
