@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Edit Stock</h3>

    <form method="POST" action="{{ route('stocks.update', $stock->id) }}">
        @csrf
        @method('PUT')

        <!-- Stockable Type -->
        <div class="mb-3">
            <label class="form-label">Item Type</label>
            <select class="form-control" name="stockable_type" id="stockable_type" required>
                <option value="">Select Type</option>
                <option value="Medicine" {{ $stock->stockable_type == \App\Models\Medicine::class ? 'selected' : '' }}>Medicine</option>
                <option value="PackagingMaterial" {{ $stock->stockable_type == \App\Models\PackagingMaterial::class ? 'selected' : '' }}>Packaging Material</option>
            </select>
        </div>

        <!-- Item Selection -->
        <div class="mb-3">
            <label class="form-label">Item</label>
            <select class="form-control" name="stockable_id" id="stockable_id" required>
                <option value="">Select Item</option>
                @foreach($medicines as $med)
                    <option value="{{ $med->id }}" 
                        {{ $stock->stockable_type == \App\Models\Medicine::class && $stock->stockable_id == $med->id ? 'selected' : '' }}>
                        {{ $med->name }}
                    </option>
                @endforeach
                @foreach($materials as $mat)
                    <option value="{{ $mat->id }}" 
                        {{ $stock->stockable_type == \App\Models\PackagingMaterial::class && $stock->stockable_id == $mat->id ? 'selected' : '' }}>
                        {{ $mat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $stock->quantity }}" required min="0">
        </div>

        <!-- Batch No -->
        <div class="mb-3">
            <label class="form-label">Batch No</label>
            <input type="text" name="batch_no" class="form-control" value="{{ $stock->batch_no }}" required>
        </div>

        <!-- Expiry Date -->
        <div class="mb-3">
            <label class="form-label">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" value="{{ $stock->expiry_date->format('Y-m-d') }}" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="available" {{ $stock->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="expired" {{ $stock->status == 'expired' ? 'selected' : '' }}>Expired</option>
            </select>
        </div>

        <!-- Factory Selection (Optional) -->
        <div class="mb-3">
            <label class="form-label">Factory (Optional)</label>
            <select class="form-control" name="factory_id">
                <option value="">Select Factory</option>
                @foreach($factories as $factory)
                    <option value="{{ $factory->id }}" 
                        {{ $stock->demands->last()->factory_id ?? '' == $factory->id ? 'selected' : '' }}>
                        {{ $factory->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Stock</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<!-- JS to dynamically populate items based on type -->


<div id="data-holder"
     data-medicines='@json($medicines)'
     data-materials='@json($materials)'>
</div>
<script>
    const holder = document.getElementById('data-holder');
    const medicines = JSON.parse(holder.dataset.medicines);
    const materials = JSON.parse(holder.dataset.materials);

    const stockableType = document.getElementById('stockable_type');
    const stockableSelect = document.getElementById('stockable_id');

    stockableType.addEventListener('change', function() {
        const type = this.value;
        stockableSelect.innerHTML = '<option value="">Select Item</option>';

        let items = [];
        if(type === 'Medicine') items = medicines;
        if(type === 'PackagingMaterial') items = materials;

        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.name;

            // preselect current item if editing
            if(type === '{{ class_basename($stock->stockable_type) }}' && item.id == '{{ $stock->stockable_id }}') {
                option.selected = true;
            }

            stockableSelect.appendChild(option);
        });
    });
</script>
@endsection
