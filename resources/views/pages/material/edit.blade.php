@extends('master')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Edit Packaging Material</h4>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('materials.update', $material->id) }}">
        @csrf
        @method('PUT')

        <input type="text" 
               class="form-control mb-2" 
               name="name" 
               placeholder="Material Name"
               value="{{ old('name', $material->name) }}"
               required>

        <input type="text" 
               class="form-control mb-2" 
               name="type" 
               placeholder="Type"
               value="{{ old('type', $material->type) }}">

        <input type="text" 
               class="form-control mb-2" 
               name="unit" 
               placeholder="Unit"
               value="{{ old('unit', $material->unit) }}">

        <input type="text" 
               class="form-control mb-2" 
               name="supplier" 
               placeholder="Supplier"
               value="{{ old('supplier', $material->supplier) }}">

        <input type="number" 
               class="form-control mb-2" 
               name="min_stock" 
               placeholder="Minimum Stock"
               value="{{ old('min_stock', $material->min_stock) }}">

        <input type="number" 
               step="0.01"
               class="form-control mb-2" 
               name="price" 
               placeholder="Price"
               value="{{ old('price', $material->price) }}">

        <select class="form-control mb-3" name="status">
            <option value="active" {{ old('status', $material->status) == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status', $material->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
