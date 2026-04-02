@extends('layouts.parent')
@section('title', $student->name . ' - Attendance')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-clipboard-check me-2 text-info"></i>{{ $student->name }} — Attendance</h4>
    <a href="{{ route('parent.dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark"><tr><th>Date</th><th>Status</th></tr></thead>
            <tbody>
                @forelse($attendance as $a)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}</td>
                    <td>
                        @if($a->status === 'present')
                            <span class="badge bg-success">Present</span>
                        @elseif($a->status === 'absent')
                            <span class="badge bg-danger">Absent</span>
                        @else
                            <span class="badge bg-warning text-dark">{{ ucfirst($a->status) }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="2" class="text-center text-muted py-4">No attendance records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($attendance->hasPages())
    <div class="card-footer">{{ $attendance->links() }}</div>
    @endif
</div>
@endsection
