@extends('layouts.parent')
@section('title', $student->name . ' - Fee Status')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-cash me-2 text-info"></i>{{ $student->name }} — Fee Status</h4>
    <a href="{{ route('parent.dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-dark"><tr><th>Fee Type</th><th>Month</th><th>Amount Due</th><th>Amount Paid</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($payments as $p)
                <tr>
                    <td>{{ ucfirst(optional($p->feeStructure)->fee_type) }}</td>
                    <td>{{ $p->month }} {{ $p->year }}</td>
                    <td>PKR {{ number_format(optional($p->feeStructure)->amount, 2) }}</td>
                    <td>PKR {{ number_format($p->amount_paid, 2) }}</td>
                    <td>
                        @if($p->status === 'paid') <span class="badge bg-success">Paid</span>
                        @elseif($p->status === 'partial') <span class="badge bg-warning text-dark">Partial</span>
                        @else <span class="badge bg-danger">Unpaid</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No fee records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($payments->hasPages())
    <div class="card-footer">{{ $payments->links() }}</div>
    @endif
</div>
@endsection

