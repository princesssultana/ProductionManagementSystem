@extends('master')

@section('content')
<h1>Products list</h1>

<a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add new Product</a>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Product Name</th>
        <th>Category Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($allProducts as $singleProduct)
        <tr>
          <td>{{ $singleProduct->id }}</td>
          <td>{{ $singleProduct->name }}</td>
           <td>{{ $singleProduct->category_id
 }}</td>
          <td>{{ $singleProduct->description }}</td>
          <td>{{ $singleProduct->price }}</td>
          <td>{{ $singleProduct->stock }}</td>
          <td>{{ $singleProduct->status }}</td>
          <td>
            <a href="#" class="btn btn-primary btn-sm">View</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

@endsection
