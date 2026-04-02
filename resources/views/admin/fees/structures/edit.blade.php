@extends('layouts.admin')
@section('title', 'Edit Fee Structure')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-pencil me-2 text-danger"></i>Edit Fee Structure</h4>
    <a href="{{ route('admin.fee-structures.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm" style="max-width:600px;">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.fee-structures.update', $feeStructure) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Class</label>
                <select name="class_id" class="form-select" required>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ old('class_id', $feeStructure->class_id)==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Fee Type</label>
                <select name="fee_type" class="form-select" required>
                    @foreach(['monthly','admission','exam','other'] as $t)
                        <option value="{{ $t }}" {{ old('fee_type', $feeStructure->fee_type)==$t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Amount (PKR)</label>
                <input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $feeStructure->amount) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <input type="text" name="description" class="form-control" value="{{ old('description', $feeStructure->description) }}">
            </div>
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i> Update</button>
        </form>
    </div>
</div>
@endsection
