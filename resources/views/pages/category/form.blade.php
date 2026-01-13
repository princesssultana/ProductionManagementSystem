@extends('master')
@section('content')
<div class="container mt-4">
    <h1>Create Medicine Production</h1>
    <hr>

  
    <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group mb-3">
            <label for="name">Category Name Input</label>
            <input name="c_name" placeholder="Enter category name here(e.g., Antibiotics)" type="text" class="form-control" id="name" required>
        </div>

       

        <div class="form-group mb-3">
            <label for="description">Enter Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>
         <div class="form-group mb-3">
            <label for="image">Upload Image</label>
            <input name="image" type="file" class="form-control" id="image">
        </div>

        <div class="form-group mb-3">
            <label for="status">Select Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                
            </select>
        </div>

          

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
