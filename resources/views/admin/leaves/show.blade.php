@extends('layouts.admin')
@section('title', 'Leave Request Detail')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-x me-2 text-danger"></i>Leave Request #{{ $leave->id }}</h4>
    <a href="{{ route('admin.leaves.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

<div class="row">
    <div class="col-md-7">
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <table class="table table-bordered">
                    <tr><th>Applicant</th><td>{{ $leave->user_name ?? '—' }}</td></tr>
                    <tr><th>Type</th><td>{{ ucfirst($leave->user_type) }}</td></tr>
                    <tr><th>From</th><td>{{ $leave->from_date->format('d M Y') }}</td></tr>
                    <tr><th>To</th><td>{{ $leave->to_date->format('d M Y') }}</td></tr>
                    <tr><th>Days</th><td>{{ $leave->from_date->diffInDays($leave->to_date) + 1 }}</td></tr>
                    <tr><th>Status</th><td>
                        @if($leave->status === 'approved') <span class="badge bg-success">Approved</span>
                        @elseif($leave->status === 'rejected') <span class="badge bg-danger">Rejected</span>
                        @else <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td></tr>
                    <tr><th>Reason</th><td>{{ $leave->reason }}</td></tr>
                    @if($leave->admin_remarks)
                    <tr><th>Admin Remarks</th><td>{{ $leave->admin_remarks }}</td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    @if($leave->status === 'pending')
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Take Action</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.leaves.update', $leave) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Decision <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="approved">Approve</option>
                            <option value="rejected">Reject</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Admin Remarks</label>
                        <textarea name="admin_remarks" class="form-control" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">Submit Decision</button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
