@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Customer Details</h3>
    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $customer->id }}</td></tr>
        <tr><th>Name</th><td>{{ $customer->name }}</td></tr>
        <tr><th>Email</th><td>{{ $customer->email }}</td></tr>
        <tr><th>Phone</th><td>{{ $customer->phone }}</td></tr>
        <tr><th>Status</th><td>{{ $customer->status }}</td></tr>
    </table>
    <a href="{{ route('customer.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
