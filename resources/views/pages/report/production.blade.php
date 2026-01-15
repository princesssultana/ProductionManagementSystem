@extends('master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📊 Medicine Production Report</h3>

    <!-- Filter -->
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <label>From Date</label>
            <input type="date" name="from" value="{{ $from }}" class="form-control">
        </div>
        <div class="col-md-4">
            <label>To Date</label>
            <input type="date" name="to" value="{{ $to }}" class="form-control">
        </div>
        <div class="col-md-4 align-self-end">
            <button class="btn btn-primary w-100">Generate Report</button>
        </div>
    </form>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h5>Total Production</h5>
                    <h3>{{ $totalProduction }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning">
                <div class="card-body">
                    <h5>Total Demand</h5>
                    <h3>{{ $totalDemand }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-info">
                <div class="card-body">
                    <h5>Total Stock</h5>
                    <h3>{{ $totalStock }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Table -->
    <div class="card">
        <div class="card-header">Production Details</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Medicine Name</th>
                        <th>Quantity</th>
                        <th>Production Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productions as $key => $production)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $production->name }}</td>  {{-- name column from products --}}
                            <td>{{ $production->stock }}</td> {{-- stock column from products --}}
                            <td>{{ $production->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-danger">
                                No data found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
