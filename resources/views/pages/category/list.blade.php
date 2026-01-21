@extends('master')


@section('content')
<h1>Category list</h1>

<a href="{{route('category.create.form')}}" class="btn btn-primary">Add new Category</a>


<div class="table-responsive">
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Category Name</th>
        <th scope="col">Category Description</th>
        <th scope="col">Status</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>


 

@foreach($categories as $category)
<tr>
    <td>{{ $category->id }}</td>
    <td>{{ $category->name }}</td>
    <td>{{ $category->description }}</td>
    <td>{{ $category->status }}</td>
    <td>
        <a href="{{route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
        <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
</form>
    
      </td>
</tr>
@endforeach






    
 

    </tbody>
  </table>
</div>

@endsection