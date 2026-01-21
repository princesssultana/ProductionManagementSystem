@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2 class="mb-4">Edit Medicine</h2>

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Errors!</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="product_name" class="form-label">Medicine Name</label>
                    <input name="product_name" placeholder="Enter Medicine Name" type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" value="{{ old('product_name', $product->name) }}" required>
                    @error('product_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="category_id" class="form-label">Select Category</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="product_stock" class="form-label">Medicine Stock</label>
                    <input name="product_stock" placeholder="Enter Medicine Stock" type="number" class="form-control @error('product_stock') is-invalid @enderror" id="product_stock" value="{{ old('product_stock', $product->stock) }}" required>
                    @error('product_stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="product_description" class="form-label">Description</label>
                    <textarea name="product_description" class="form-control @error('product_description') is-invalid @enderror" id="product_description" rows="4">{{ old('product_description', $product->description) }}</textarea>
                    @error('product_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="">-- Select Status --</option>
                        <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label class="form-label">Assign Packaging Materials</label>
                    <div id="packagingMaterialsContainer">
                        @php
                            $assignedMaterialsWithQty = $product->packagingMaterials()->get();
                        @endphp
                        @if($assignedMaterialsWithQty->count() > 0)
                            @foreach($assignedMaterialsWithQty as $material)
                                <div class="packaging-material-row mb-2 p-3 bg-light rounded">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <select name="packaging_materials[]" class="form-select" required>
                                                <option value="">-- Select Material --</option>
                                                @foreach($packagingMaterials as $pm)
                                                    <option value="{{ $pm->id }}" {{ $material->id == $pm->id ? 'selected' : '' }}>{{ $pm->name ?? 'Material ' . $pm->id }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="number" name="material_quantities[]" class="form-control" placeholder="Qty per unit" step="0.01" value="{{ $material->pivot->quantity_per_unit }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-danger btn-sm remove-material">×</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" id="addMaterialBtn">+ Add Material</button>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update Medicine</button>
                    <a href="{{ route('products.list') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('addMaterialBtn').addEventListener('click', function() {
    const container = document.getElementById('packagingMaterialsContainer');
    const materialRow = document.createElement('div');
    materialRow.className = 'packaging-material-row mb-2 p-3 bg-light rounded';
    materialRow.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <select name="packaging_materials[]" class="form-select" required>
                    <option value="">-- Select Material --</option>
                    @foreach($packagingMaterials as $material)
                        <option value="{{ $material->id }}">{{ $material->name ?? 'Material ' . $material->id }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="material_quantities[]" class="form-control" placeholder="Qty per unit" step="0.01" value="0">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger btn-sm remove-material">×</button>
            </div>
        </div>
    `;
    container.appendChild(materialRow);
    
    // Attach remove listener to new button
    materialRow.querySelector('.remove-material').addEventListener('click', function() {
        materialRow.remove();
    });
});

// Attach remove listeners to existing buttons
document.querySelectorAll('.remove-material').forEach(button => {
    button.addEventListener('click', function() {
        this.closest('.packaging-material-row').remove();
    });
});
</script>

@endsection
