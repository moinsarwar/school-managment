@extends('layouts.admin')
@section('title', 'Fee Payments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-cash-stack me-2 text-danger"></i>Fee Payments</h4>
    <div>
        <a href="{{ route('admin.fee-payments.defaulters') }}" class="btn btn-outline-warning me-2">
            <i class="bi bi-exclamation-triangle me-1"></i> Defaulters
        </a>
        <a href="{{ route('admin.fee-payments.create') }}" class="btn btn-danger">
            <i class="bi bi-plus-lg me-1"></i> Collect Fee
        </a>
    </div>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-auto">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    @foreach(['paid','partial','unpaid'] as $s)
                        <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <input type="text" name="month" class="form-control form-control-sm" placeholder="Month e.g. January" value="{{ request('month') }}">
            </div>
            <div class="col-auto">
                <input type="text" name="year" class="form-control form-control-sm" placeholder="Year e.g. 2025" value="{{ request('year') }}" maxlength="4">
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary">Filter</button>
                <a href="{{ route('admin.fee-payments.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Student</th><th>Fee Type</th><th>Month/Year</th><th>Amount Paid</th><th>Status</th><th>Paid Date</th></tr>
            </thead>
            <tbody>
                @forelse($payments as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ optional($p->student)->name }}</td>
                    <td>{{ optional($p->feeStructure)->fee_type }}</td>
                    <td>{{ $p->month }} {{ $p->year }}</td>
                    <td>PKR {{ number_format($p->amount_paid, 2) }}</td>
                    <td>
                        @if($p->status === 'paid') <span class="badge bg-success">Paid</span>
                        @elseif($p->status === 'partial') <span class="badge bg-warning text-dark">Partial</span>
                        @else <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                    <td>{{ $p->paid_date ? $p->paid_date->format('d M Y') : '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No payments recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($payments->hasPages())
    <div class="card-footer">{{ $payments->links() }}</div>
    @endif
</div>
@endsection
