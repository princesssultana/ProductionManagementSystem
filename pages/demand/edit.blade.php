@extends('master')

@section('content')

<div class="container mt-4">
    <h3>Edit / Approve Demand</h3>

    <form action="{{ route('demands.update', $demand->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Demand Name</label>
            <input type="text" class="form-control" value="{{ $demand->name }}" disabled>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" class="form-control" value="{{ $demand->qty }}" disabled>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="Pending" {{ $demand->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Approved" {{ $demand->status == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Rejected" {{ $demand->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

      <div class="form-group">
    <label>Approved Quantity (if approving)</label>
    <input 
        name="approved_qty" 
        type="number" 
        class="form-control" 
        value="{{ $demand->status == 'Approved' ? $demand->approved_qty : '' }}"
        min="1"
        max="{{ $demand->material->stock ?? 0 }}"
    >
</div>


        <button type="submit" class="btn btn-success mt-3">Update</button>
        <a href="{{ route('demands.index') }}" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

@endsection

