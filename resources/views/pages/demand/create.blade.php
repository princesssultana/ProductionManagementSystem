@extends('master')

@section('content')

<div class="container mt-4">
    <h3>Add New Demand</h3>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('demands.store') }}" method="POST">
        @csrf

        {{-- Select Medicine --}}
        <div class="form-group mb-3">
            <label>Medicine</label>
            <select name="medicine_id" class="form-control" required>
                <option value="">-- Select Medicine --</option>
                @foreach($medicines as $medicine)
                    <option value="{{ $medicine->id }}">
                        {{ $medicine->name }} (Stock: {{ $medicine->stock ?? 0 }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Demand Note --}}
        <div class="form-group mb-3">
            <label>Demand Note</label>
            <input
                name="name"
                type="text"
                class="form-control"
                placeholder="Optional note"
                value="{{ old('name') }}"
            >
        </div>

        {{-- Quantity --}}
        <div class="form-group mb-3">
            <label>Quantity</label>
            <input
                name="qty"
                type="number"
                class="form-control"
                placeholder="Enter quantity"
                value="{{ old('qty') }}"
                required
            >
        </div>

        <button type="submit" class="btn btn-success">Save Demand</button>
        <a href="{{ route('demands.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
