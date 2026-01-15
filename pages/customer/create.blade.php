@extends('master')

@section('content')

<div class="container mt-4">
    <h3>Add New Customer</h3>

    <form action="{{route('customer.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Customer Name</label>
            <input name="name" type="text" class="form-control" placeholder="Enter customer name" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input name="email" type="email" class="form-control" placeholder="Enter email" required>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input name="phone" type="text" class="form-control" placeholder="Enter phone number" required>
        </div>

        <div class="form-group">
            <label>Address</label>
            <textarea name="address" class="form-control" placeholder="Enter address" required></textarea>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input name="password" type="password" class="form-control" placeholder="Enter password" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Customer</button>

    </form>
</div>

@endsection
