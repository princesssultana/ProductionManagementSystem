@extends('master')

@section('content')
<h1>Products list</h1>

<a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Add new Product</a>

<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th scope="col">Product Name</th>
        <th scope="col">Image</th>
        <th scope="col">Category Name</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Stock</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($allProducts as $singleProduct)
        <tr>
          <td>{{ $singleProduct->id }}</td>
          <td>{{ $singleProduct->name }}</td>
          <td>
          <img width="100px" src="{{url('/products/'.$singleProduct->image)}}" alt="test">
        </td>
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
