@extends('master')

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">{{ $product->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Medicine ID</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $product->id }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Category</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $category ? $category->name : 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Stock</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $product->stock }} units
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Description</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $product->description ?? 'No description available' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </div>
                    </div>

                    @if($packagingMaterials && count($packagingMaterials) > 0)
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Packaging Materials</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Material Name</th>
                                        <th>Qty Per Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($packagingMaterials as $material)
                                    <tr>
                                        <td>{{ $material->name ?? 'Material ' . $material->id }}</td>
                                        <td>{{ $material->pivot->quantity_per_unit }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Created At</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $product->created_at ? $product->created_at->format('M d, Y H:i') : 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Updated At</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $product->updated_at ? $product->updated_at->format('M d, Y H:i') : 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this medicine?')">Delete</button>
                    </form>
                    <a href="{{ route('products.list') }}" class="btn btn-secondary">Back to Medicines</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
