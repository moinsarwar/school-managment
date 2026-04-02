@extends('layouts.teacher')
@section('title', 'Mark Attendance')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-clipboard-check me-2"></i>Mark Attendance — {{ $today }}</h4>

    @if($students->isEmpty())
        <div class="alert alert-warning">No students found in your assigned class.</div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('teacher.attendance.store') }}">
                    @csrf
                    <input type="hidden" name="date" value="{{ $today }}">
                    <table class="table table-hover mb-3 dt-table">
                        <thead class="table-light">
                            <tr>
                                <th>Roll</th>
                                <th>Student Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $s)
                                <tr>
                                    <td>{{ $s->roll_number ?? '-' }}</td>
                                    <td class="fw-semibold">{{ $s->name }}</td>
                                    <td>
                                        @php $current = $existing[$s->id] ?? 'present'; @endphp
                                        <div class="btn-group" role="group">
                                            <input type="radio" class="btn-check" name="attendance[{{ $s->id }}]"
                                                id="present_{{ $s->id }}" value="present" {{ $current == 'present' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success btn-sm" for="present_{{ $s->id }}">Present</label>
                                            <input type="radio" class="btn-check" name="attendance[{{ $s->id }}]"
                                                id="absent_{{ $s->id }}" value="absent" {{ $current == 'absent' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger btn-sm" for="absent_{{ $s->id }}">Absent</label>
                                            <input type="radio" class="btn-check" name="attendance[{{ $s->id }}]"
                                                id="late_{{ $s->id }}" value="late" {{ $current == 'late' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-warning btn-sm" for="late_{{ $s->id }}">Late</label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg me-1"></i> Save Attendance</button>
                    <a href="{{ route('teacher.attendance.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    @endif
@endsection
