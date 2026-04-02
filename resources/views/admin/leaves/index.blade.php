@extends('layouts.admin')
@section('title', 'Leave Requests')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-x me-2 text-danger"></i>Leave Requests</h4>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2">
            <div class="col-auto">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    @foreach(['pending','approved','rejected'] as $s)
                        <option value="{{ $s }}" {{ request('status')==$s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select name="user_type" class="form-select form-select-sm">
                    <option value="">All Types</option>
                    <option value="teacher" {{ request('user_type')=='teacher' ? 'selected' : '' }}>Teachers</option>
                    <option value="student" {{ request('user_type')=='student' ? 'selected' : '' }}>Students</option>
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary">Filter</button>
                <a href="{{ route('admin.leaves.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Name</th><th>Type</th><th>From</th><th>To</th><th>Status</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($leaves as $l)
                <tr>
                    <td>{{ $l->id }}</td>
                    <td>{{ $l->user_name ?? '—' }}</td>
                    <td><span class="badge bg-secondary">{{ ucfirst($l->user_type) }}</span></td>
                    <td>{{ $l->from_date->format('d M Y') }}</td>
                    <td>{{ $l->to_date->format('d M Y') }}</td>
                    <td>
                        @if($l->status === 'approved') <span class="badge bg-success">Approved</span>
                        @elseif($l->status === 'rejected') <span class="badge bg-danger">Rejected</span>
                        @else <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.leaves.show', $l) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No leave requests found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($leaves->hasPages())
    <div class="card-footer">{{ $leaves->links() }}</div>
    @endif
</div>
@endsection
