@extends('layouts.teacher')
@section('title', 'My Leaves')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-x me-2 text-primary"></i>My Leave Applications</h4>
    <a href="{{ route('teacher.leaves.create') }}" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Apply for Leave</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-dark">
                <tr><th>#</th><th>From</th><th>To</th><th>Reason</th><th>Status</th><th>Admin Remarks</th></tr>
            </thead>
            <tbody>
                @forelse($leaves as $l)
                <tr>
                    <td>{{ $l->id }}</td>
                    <td>{{ $l->from_date->format('d M Y') }}</td>
                    <td>{{ $l->to_date->format('d M Y') }}</td>
                    <td>{{ Str::limit($l->reason, 50) }}</td>
                    <td>
                        @if($l->status === 'approved') <span class="badge bg-success">Approved</span>
                        @elseif($l->status === 'rejected') <span class="badge bg-danger">Rejected</span>
                        @else <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                    <td>{{ $l->admin_remarks ?? '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No leaves applied yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($leaves->hasPages())
    <div class="card-footer">{{ $leaves->links() }}</div>
    @endif
</div>
@endsection

