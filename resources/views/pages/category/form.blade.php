@extends('master')
@section('content')
<h1>Create Medicine Production</h1>

<!-- medicine name, batch, quantity, date, image, status, description -->


<form action="{{route('category.store')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="medicine_name">Enter Medicine Name</label>
    <input  name="medicine_name" placeholder="Enter medicine name here..." type="text" class="form-control" id="medicine_name" aria-describedby="emailHelp">
    
  </div>

  <div class="form-group">
    <label for="batch">Enter Batch Number</label>
    <input name="batch_no" placeholder="Enter Batch Number..." type="number" class="form-control" id="batch" aria-describedby="emailHelp">
    
  </div>

  <div class="form-group">
    <label for="qty">Production Quantity</label>
    <input name="quantity" type="number" class="form-control" id="qty" aria-describedby="emailHelp">
    
  </div>

  <div class="form-group">
    <label for="p_date">Production Date</label>
    <input name="production_date" type="date" class="form-control" id="p_date" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="exp_date">Expiry Date</label>
    <input name="expiry_date" type="date" class="form-control" id="exp_date" aria-describedby="emailHelp">
    
  </div>
  <div class="form-group">
    <label for="image">Upload Medicine Image</label>
    <input name="image" type="file" class="form-control" id="image">
  </div>

  <div class="form-group">
    <label for="description">Enter Description</label>
    <input name="description" type="text" class="form-control" id="description">
  </div>

    <div class="form-group">
    <label for="status">Select Status</label>
    <select name="status" id="status" class="form-control">
      <option value="pending">Pending</option>
      <option value="completed">Completed</option>
      <option value="cancelled">Cancelled</option>
    </select>
  </div>


  <br>
   
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection