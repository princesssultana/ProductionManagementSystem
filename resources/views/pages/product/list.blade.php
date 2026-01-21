@extends('master')

@section('content')
<h1>Medicines List</h1>

<a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add New Medicine</a>

@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Medicine Name</th>
        <th>Category Name</th>
        <th>Description</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($allProducts as $singleProduct)
        <tr>
          <td>{{ $singleProduct->id }}</td>
          <td>{{ $singleProduct->name }}</td>
          <td>{{ $singleProduct->category ? $singleProduct->category->name : 'N/A' }}</td>
          <td>{{ Str::limit($singleProduct->description, 50) }}</td>
          <td>
            <span class="badge {{ $singleProduct->status === 'active' ? 'bg-success' : 'bg-danger' }}">
              {{ ucfirst($singleProduct->status) }}
            </span>
          </td>
          <td>
            <a href="{{ route('product.show', $singleProduct->id) }}" class="btn btn-primary btn-sm">View</a>
            <a href="{{ route('product.edit', $singleProduct->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('product.destroy', $singleProduct->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="8" class="text-center">No products found. <a href="{{ route('product.create') }}">Create one now</a></td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection
