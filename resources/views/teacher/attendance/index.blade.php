@extends('layouts.teacher')
@section('title', 'Attendance Records')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-clipboard-check me-2"></i>Attendance Records</h4>
        <a href="{{ route('teacher.attendance.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i> Mark
            Attendance</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $a)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $a->student->name ?? '-' }}</td>
                            <td>
                                @if($a->status == 'present')<span class="badge bg-success">Present</span>
                                @elseif($a->status == 'absent')<span class="badge bg-danger">Absent</span>
                                @else<span class="badge bg-warning text-dark">Late</span>@endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">No attendance records yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($attendances->hasPages())
        <div class="card-footer">{{ $attendances->links() }}</div>@endif
    </div>
@endsection
