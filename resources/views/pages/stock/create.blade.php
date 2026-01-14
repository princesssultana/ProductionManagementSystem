@extends('master')

@section('content')
<div class="container mt-4">
    <h3>Add New Stock</h3>

    <form method="POST" action="{{ route('stocks.store') }}">
        @csrf

        <!-- Stockable Type -->
        <div class="mb-3">
            <label class="form-label">Item Type</label>
            <select class="form-control" name="stockable_type" id="stockable_type" required>
                <option value="">Select Type</option>
                <option value="Medicine">Medicine</option>
                <option value="PackagingMaterial">Packaging Material</option>
            </select>
        </div>

        <!-- Item Selection -->
        <div class="mb-3">
            <label class="form-label">Item</label>
            <select class="form-control" name="stockable_id" id="stockable_id" required>
                <option value="">Select Item</option>
                <!-- JS will populate based on Type -->
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" required min="0">
        </div>

        <!-- Batch No -->
        <div class="mb-3">
            <label class="form-label">Batch No</label>
            <input type="text" name="batch_no" class="form-control" required>
        </div>

        <!-- Expiry Date -->
        <div class="mb-3">
            <label class="form-label">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="available">Available</option>
                <option value="expired">Expired</option>
            </select>
        </div>

        <!-- Factory Selection (Optional) -->
        <div class="mb-3">
            <label class="form-label">Factory (Optional)</label>
            <select class="form-control" name="factory_id">
                <option value="">Select Factory</option>
                @foreach($factories as $factory)
                    <option value="{{ $factory->id }}">{{ $factory->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Stock</button>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>


<div id="data-holder"
     data-medicines='@json($medicines)'
     data-materials='@json($materials)'>
</div>

<!-- JS to populate items based on Type -->
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
            stockableSelect.appendChild(option);
        });
    });
</script>

@endsection
