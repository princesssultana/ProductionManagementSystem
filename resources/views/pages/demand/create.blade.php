@extends('master')

@section('content')

<div class="container mt-4">
    <h3>Add New Demand</h3>

    <form action="{{ route('demands.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Demand Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter demand name" required>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input name="qty" type="number" class="form-control" placeholder="Enter quantity" required>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Demand</button>
        <a href="{{ route('demands.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

@endsection
