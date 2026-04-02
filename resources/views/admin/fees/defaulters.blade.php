@extends('layouts.admin')
@section('title', 'Fee Defaulters')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-exclamation-triangle me-2 text-warning"></i>Fee Defaulters — {{ $currentMonth }} {{ $currentYear }}</h4>
    <a href="{{ route('admin.fee-payments.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

@if($unpaid->isEmpty())
    <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>No defaulters found for {{ $currentMonth }} {{ $currentYear }}.</div>
@else
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-dark">
                <tr><th>#</th><th>Student</th><th>Class</th><th>Fee Type</th><th>Amount Due</th><th>Amount Paid</th><th>Status</th></tr>
            </thead>
            <tbody>
                @foreach($unpaid as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ optional($p->student)->name }}</td>
                    <td>{{ optional(optional($p->student)->schoolClass)->name }}</td>
                    <td>{{ ucfirst(optional($p->feeStructure)->fee_type) }}</td>
                    <td>PKR {{ number_format(optional($p->feeStructure)->amount, 2) }}</td>
                    <td>PKR {{ number_format($p->amount_paid, 2) }}</td>
                    <td>
                        @if($p->status === 'partial') <span class="badge bg-warning text-dark">Partial</span>
                        @else <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection

