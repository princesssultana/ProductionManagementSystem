@extends('master')
@section('content')
<div class="container mt-4">
    <h1>Create Medicine Production</h1>
    <hr>

  
    <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group mb-3">
            <label for="medicine_name">Enter Medicine Name</label>
            <input name="medicine_name" placeholder="Enter medicine name here..." type="text" class="form-control" id="medicine_name" required>
        </div>

        <div class="form-group mb-3">
            <label for="batch">Enter Batch Number</label>
            <input name="batch_no" placeholder="Enter Batch Number..." type="text" class="form-control" id="batch" required>
        </div>

        <div class="form-group mb-3">
            <label for="qty">Production Quantity</label>
            <input name="quantity" type="number" class="form-control" id="qty" required>
        </div>

        <div class="form-group mb-3">
            <label for="p_date">Production Date</label>
            <input name="production_date" type="date" class="form-control" id="p_date" required>
        </div>

        <div class="form-group mb-3">
            <label for="exp_date">Expiry Date</label>
            <input name="expiry_date" type="date" class="form-control" id="exp_date">
        </div>

        <div class="form-group mb-3">
            <label for="image">Upload Medicine Image</label>
            <input name="image" type="file" class="form-control" id="image">
        </div>

        <div class="form-group mb-3">
            <label for="description">Enter Description</label>
            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="status">Select Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
                
            </select>
        </div>

          

        <button type="submit" class="btn btn-primary">Submit Production</button>
    </form>
</div>
@endsection
