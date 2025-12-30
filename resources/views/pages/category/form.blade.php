@extends('master')
@section('content')
<h1>Create Category</h1>

<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Enter Category Name</label>
    <input placeholder="Enter category name here..." type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Enter description</label>
    <input type="text" class="form-control" id="exampleInputPassword1">
  </div>

  <br>
   
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection