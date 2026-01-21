@extends('master')
@section('content')
<div class="container mt-4">
    <h1>Edit Medicine Production</h1>
    <hr>

    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="name">Category Name Input</label>
            <input name="name" placeholder="Enter category name here(e.g., Antibiotics)" type="text" class="form-control" id="name" required
                value="{{ old('name', $category->name) }}">
        </div>

        <div class="form-group mb-3">
            <label for="description">Enter Description</label>
            <textarea name="description" class="form-control" id="description" rows="3">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="image">Upload Image</label>
            <input name="image" type="file" class="form-control" id="image">
            @if($category->image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="120">
                </div>
            @endif
        </div>

        <div class="form-group mb-3">
            <label for="status">Select Status</label>
            <select name="status" id="status" class="form-control">
                <option value="active" {{ old('status', $category->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $category->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('category.list') }}" class="btn btn-secondary ms-2">Back</a>
    </form>
</div>
@endsection