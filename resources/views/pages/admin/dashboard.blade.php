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

    {{-- তারপর তোমার চার্ট --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5>Monthly Demand vs Stock</h5>
            <canvas id="monthlyChart"></canvas>
        </div>
    </div>

    {{-- Low Stock Alert Chart --}}
    <div class="card">
        <div class="card-body">
            <h5 class="text-danger">Low Stock Alert</h5>
            <canvas id="lowStockChart"></canvas>
        </div>
    </div>

</div>
@endsection

<div class="container mt-4">

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

    {{-- Chart --}}
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3">Monthly Demand vs Stock</h5>
            <canvas id="monthlyChart" height="100"></canvas>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const labels = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
<div id="chartData"
     data-demand="{{ json_encode(array_values(array_replace(array_fill(1,12,0), $monthlyDemands->toArray()))) }}"
     data-stock="{{ json_encode(array_values(array_replace(array_fill(1,12,0), $monthlyStock->toArray()))) }}">
</div>


const chartDiv = document.getElementById('chartData');
const demandData = JSON.parse(chartDiv.dataset.demand);
const stockData  = JSON.parse(chartDiv.dataset.stock);
</script>


        
    
   

@endpush

