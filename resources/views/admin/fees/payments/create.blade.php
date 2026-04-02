@extends('layouts.admin')
@section('title', 'Collect Fee')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-cash me-2 text-danger"></i>Collect Fee Payment</h4>
    <a href="{{ route('admin.fee-payments.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm" style="max-width:650px;">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.fee-payments.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Student <span class="text-danger">*</span></label>
                <select name="student_id" class="form-select" required>
                    <option value="">-- Select Student --</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" {{ old('student_id')==$s->id ? 'selected' : '' }}>
                            {{ $s->name }} ({{ optional($s->schoolClass)->name }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Fee Structure <span class="text-danger">*</span></label>
                <select name="fee_structure_id" class="form-select" required>
                    <option value="">-- Select Fee --</option>
                    @foreach($structures as $fs)
                        <option value="{{ $fs->id }}" {{ old('fee_structure_id')==$fs->id ? 'selected' : '' }}>
                            {{ optional($fs->schoolClass)->name }} — {{ ucfirst($fs->fee_type) }} (PKR {{ number_format($fs->amount,2) }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Month <span class="text-danger">*</span></label>
                    <input type="text" name="month" class="form-control" value="{{ old('month', date('F')) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Year <span class="text-danger">*</span></label>
                    <input type="text" name="year" class="form-control" maxlength="4" value="{{ old('year', date('Y')) }}" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Amount Paid <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="amount_paid" class="form-control" value="{{ old('amount_paid') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        @foreach(['paid','partial','unpaid'] as $s)
                            <option value="{{ $s }}" {{ old('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Paid Date</label>
                    <input type="date" name="paid_date" class="form-control" value="{{ old('paid_date', date('Y-m-d')) }}">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Remarks</label>
                <textarea name="remarks" class="form-control" rows="2">{{ old('remarks') }}</textarea>
            </div>
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i> Record Payment</button>
        </form>
    </div>
</div>
@endsection
