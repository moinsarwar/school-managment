@extends('layouts.admin')
@section('title', 'Attendance Reports')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-clipboard-check me-2"></i>Attendance Reports</h4>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter by Class</label>
                    <select name="class_id" class="form-select">
                        <option value="">All Classes</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ request('class_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Filter by Date</label>
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-danger"><i class="bi bi-funnel me-1"></i> Filter</button>
                    <a href="{{ route('admin.attendance.index') }}" class="btn btn-secondary ms-1">Clear</a>
                </div>
            </form>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Class</th>
                        <th>Status</th>
                        <th>Marked By</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $a)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($a->date)->format('d M Y') }}</td>
                            <td class="fw-semibold">{{ $a->student->name ?? '-' }}</td>
                            <td>{{ $a->schoolClass->name ?? '-' }}</td>
                            <td>
                                @if($a->status == 'present')<span class="badge bg-success">Present</span>
                                @elseif($a->status == 'absent')<span class="badge bg-danger">Absent</span>
                                @else<span class="badge bg-warning text-dark">Late</span>@endif
                            </td>
                            <td>{{ $a->teacher->name ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($attendances->hasPages())
            <div class="card-footer">{{ $attendances->withQueryString()->links() }}</div>
        @endif
    </div>
@endsection
