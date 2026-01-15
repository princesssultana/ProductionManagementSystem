@extends('master')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🏭 Create Factory Settings</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('factories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label>Factory Name</label>
                    <input type="text" name="factory_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Max Capacity</label>
                    <input type="number" name="max_capacity" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Min Stock Threshold</label>
                    <input type="number" name="min_stock_threshold" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save Factory</button>
            </form>
        </div>
    </div>
</div>
@endsection
