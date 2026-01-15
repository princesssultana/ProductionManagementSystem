@extends('master')

@section('content')
<div class="container mt-4">

    {{-- Year filter dropdown --}}
    <form method="GET" class="mb-3">
        <select name="year" class="form-select w-25" onchange="this.form.submit()">
            @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                    {{ $y }}
                </option>
            @endfor
        </select>
    </form>

    {{-- Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Materials</h6>
                    <h2 class="text-primary">{{ $materials }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Total Demands</h6>
                    <h2 class="text-success">{{ $demands }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h6>Pending</h6>
                    <h2 class="text-danger">{{ $pending }}</h2>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>Monthly Demand vs Stock</h5>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="text-danger">Low Stock Alert</h5>
            <canvas id="lowStockChart"></canvas>
        </div>
    </div>

    {{-- Hidden div for passing chart data --}}
    <div id="chartData"
         data-demand="{{ json_encode(array_values(array_replace(array_fill(1,12,0), $monthlyDemands->toArray()))) }}"
         data-stock="{{ json_encode(array_values(array_replace(array_fill(1,12,0), $monthlyStock->toArray()))) }}">
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];

// Get chart data from hidden div
const chartDiv = document.getElementById('chartData');
const demandData = JSON.parse(chartDiv.dataset.demand);
const stockData  = JSON.parse(chartDiv.dataset.stock);

// Monthly Demand vs Stock Chart
new Chart(document.getElementById('monthlyChart'), {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            { label: 'Demand', data: demandData, backgroundColor: 'rgba(54,162,235,0.6)' },
            { label: 'Stock', data: stockData, backgroundColor: 'rgba(255,99,132,0.6)' }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } }
    }
});

// Low Stock Alert Chart (example line chart)
new Chart(document.getElementById('lowStockChart'), {
    type: 'line',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'Low Stock',
                data: stockData.map(q => q < 100 ? q : 0),
                borderColor: 'red',
                backgroundColor: 'rgba(255,0,0,0.1)',
                fill: true,
                tension: 0.3
            }
        ]
    },
    options: {
        responsive: true,
        plugins: { legend: { position: 'top' } }
    }
});
</script>
@endpush
