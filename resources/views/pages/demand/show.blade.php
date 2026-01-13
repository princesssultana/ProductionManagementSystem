@extends('master')

@section('content')

<div class="container mt-4">
    <h3>Demand Details</h3>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $demand->id }}</td></tr>
        <tr><th>Name</th><td>{{ $demand->name }}</td></tr>
        <tr><th>Qty</th><td>{{ $demand->qty }}</td></tr>
        <tr><th>Approved Qty</th><td>{{ $demand->approved_qty ?? '-' }}</td></tr>
        <tr><th>Status</th><td>{{ $demand->status }}</td></tr>
        <tr><th>Date Approved</th><td>{{ $demand->date_approved ?? '-' }}</td></tr>
    </table>

    <a href="{{ route('demands.index') }}" class="btn btn-primary">Back</a>
</div>

@endsection
