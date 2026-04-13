@extends('master')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Create Production Order</h2>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h5>Validation Errors:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('demands.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-8">
                <!-- Cart Section -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Medicines for Production</h5>
                    </div>
                    <div class="card-body">
                        <div id="cartItems">
                            <!-- Items will be added here -->
                        </div>
                        <button type="button" class="btn btn-secondary btn-sm" id="addItemBtn">+ Add Medicine</button>
                    </div>
                </div>

                <!-- Production Order Note -->
                <div class="form-group mb-4">
                    <label class="form-label">Order Note (Optional)</label>
                    <textarea name="name" class="form-control" placeholder="Add a note for this production order" rows="3">{{ old('name') }}</textarea>
                </div>
            </div>

            <!-- Summary Section -->
            <div class="col-md-4">
                <div class="card sticky-top" style="top: 20px;">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <h6>Total Items: <span id="totalItems" class="badge bg-primary">0</span></h6>
                        </div>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody id="summaryBody">
                                <!-- Summary populated by JS -->
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-success w-100" id="submitBtn" disabled>Create Demand</button>
                        <a href="{{ route('demands.index') }}" class="btn btn-secondary w-100 mt-2">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
const medicines = @json($medicines);

document.getElementById('addItemBtn').addEventListener('click', function() {
    addCartItem();
});

function addCartItem() {
    const container = document.getElementById('cartItems');
    const itemCount = container.children.length;
    
    const itemHTML = `
        <div class="cart-item mb-3 p-3 border rounded" data-index="${itemCount}">
            <div class="row align-items-end">
                <div class="col-md-6">
                    <label class="form-label">Product</label>
                    <select name="products[]" class="form-select product-select" required onchange="updateSummary()">
                        <option value="">-- Select Product --</option>
                        ${medicines.map(m => `<option value="${m.id}">${m.name} (Stock: ${m.stock})</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantities[]" class="form-control qty-input" min="1" step="1" required onchange="updateSummary()">
                </div>
                <div class="col-md-2">
                    <label class="form-label">&nbsp;</label>
                    <button type="button" class="btn btn-danger btn-sm w-100 remove-item">Remove</button>
                </div>
                <div class="col-md-1" id="packing-${itemCount}" style="display:none;"></div>
            </div>
            <div id="materials-${itemCount}" class="mt-2" style="display:none;">
                <table class="table table-sm table-bordered mb-0" style="font-size: 0.85rem;">
                    <thead class="table-light">
                        <tr>
                            <th>Packing Material</th>
                            <th>Qty Per Unit</th>
                            <th>Total Needed</th>
                        </tr>
                    </thead>
                    <tbody id="materials-body-${itemCount}"></tbody>
                </table>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', itemHTML);
    
    const lastItem = container.lastElementChild;
    lastItem.querySelector('.remove-item').addEventListener('click', function() {
        lastItem.remove();
        updateSummary();
    });
    
    const productSelect = lastItem.querySelector('.product-select');
    productSelect.addEventListener('change', function() {
        updateMaterials(itemCount);
        updateSummary();
    });
}

function updateMaterials(index) {
    const item = document.querySelector(`[data-index="${index}"]`);
    const productSelect = item.querySelector('.product-select');
    const qtyInput = item.querySelector('.qty-input');
    const materialsDiv = document.getElementById(`materials-${index}`);
    const materialsBody = document.getElementById(`materials-body-${index}`);
    
    const productId = productSelect.value;
    const qty = parseFloat(qtyInput.value) || 0;
    
    if (!productId || qty === 0) {
        materialsDiv.style.display = 'none';
        return;
    }
    
    const product = medicines.find(m => m.id == productId);
    if (product && product.packaging_materials && product.packaging_materials.length > 0) {
        materialsBody.innerHTML = product.packaging_materials.map(material => {
            const totalNeeded = (material.pivot.quantity_per_unit * qty).toFixed(2);
            return `
                <tr>
                    <td>${material.name || 'Material ' + material.id}</td>
                    <td>${material.pivot.quantity_per_unit}</td>
                    <td><strong>${totalNeeded}</strong></td>
                </tr>
            `;
        }).join('');
        materialsDiv.style.display = 'block';
    } else {
        materialsDiv.style.display = 'none';
    }
}

function updateSummary() {
    const items = document.querySelectorAll('.cart-item');
    let totalItems = 0;
    const summaryBody = document.getElementById('summaryBody');
    const submitBtn = document.getElementById('submitBtn');
    
    let summaryHTML = '';
    
    items.forEach(item => {
        const productSelect = item.querySelector('.product-select');
        const qtyInput = item.querySelector('.qty-input');
        const index = item.getAttribute('data-index');
        
        if (productSelect.value && qtyInput.value) {
            updateMaterials(index);
            const product = medicines.find(m => m.id == productSelect.value);
            summaryHTML += `
                <tr>
                    <td>${product.name}</td>
                    <td>${qtyInput.value}</td>
                </tr>
            `;
            totalItems += parseFloat(qtyInput.value);
        }
    });
    
    document.getElementById('totalItems').textContent = totalItems;
    summaryBody.innerHTML = summaryHTML || '<tr><td colspan="2" class="text-center text-muted">No items added</td></tr>';
    submitBtn.disabled = totalItems === 0;
}

// Add first item on load
addCartItem();
</script>

@endsection
