@extends('master')

@section('content')

<form action="{{route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="product_name">Enter Product Name</label>
        <input name="product_name" placeholder="Enter Product Name here.." type="text" class="form-control" id="product_name">
    </div>



<label>Select Category</label>
<select name="category_id" class="form-select" required>
    <option value="">-- Select Category --</option>
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
    @endforeach
</select>



</div>


    <div class="form-group">
        <label for="name">Enter Product Price</label>
        <input name="product_price" placeholder="Enter Product Price here.." type="number" class="form-control" id="name" aria-describedby="emailHelp">
    </div>

    <div class="form-group">
        <label for="product_stock">Enter Product Stock</label>
        <input name="product_stock" placeholder="Enter Product Stock here.." type="number" class="form-control" id="product_stock">
    </div>

    <div class="form-group">
        <label for="desc">Enter description</label>
        <textarea name="product_description" class="form-control" id="desc"></textarea>
    </div>

    <div class="form-group">
        <label for="image">Upload Image</label>
        <input name="image" type="file" class="form-control" id="image">
    </div>

    <div class="form-group">
        <label for="status">Select Status</label>
        <select name="status" id="status" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
