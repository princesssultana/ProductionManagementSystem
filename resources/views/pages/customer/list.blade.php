@extends('master')

@section('content')
<h1>Customer list</h1>

<a href="{{route('customer.create') }}" class="btn btn-primary mb-3">Add new Customer</a>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th> Name</th>
        <th>Phone</th>
        <th>Email</th>
        
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($customers as $cust)
       <tr>
    <td>{{ $cust->id }}</td>
    <td>{{ $cust->name }}</td>
    <td>{{ $cust->phone }}</td>
    <td>{{ $cust->email }}</td>
    <td>{{ $cust->status }}</td>
    <td>
        <a href="{{ route('customer.view', $cust->id) }}" class="btn btn-sm btn-info">View</a>
        <a href="{{ route('customer.edit', $cust->id) }}" class="btn btn-sm btn-warning">Edit</a>
        <form action="{{ route('customer.destroy', $cust->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
    </td>
</tr>

      @endforeach
    </tbody>
  </table>
</div>

@endsection
