@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Add New Material</h3>

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

    <form method="POST" action="{{ route('materials.store') }}">
        @csrf

        <input class="form-control mb-2" name="name" placeholder="Material Name" 
               value="{{ old('name') }}">
        <input class="form-control mb-2" name="type" placeholder="Type" 
               value="{{ old('type') }}">
        <input class="form-control mb-2" name="unit" placeholder="Unit" 
               value="{{ old('unit') }}">
        <input class="form-control mb-2" name="supplier" placeholder="Supplier" 
               value="{{ old('supplier') }}">
        <input class="form-control mb-2" name="min_stock" placeholder="Min Stock" 
               type="number" value="{{ old('min_stock') }}">
        <input class="form-control mb-2" name="price" placeholder="Price" 
               type="number" step="0.01" value="{{ old('price') }}">

        <select class="form-control mb-3" name="status">
            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        <button class="btn btn-success">Save</button>
        <a href="{{ route('materials.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
