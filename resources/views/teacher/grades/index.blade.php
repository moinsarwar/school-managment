@extends('layouts.teacher')
@section('title', 'Grades')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-file-earmark-bar-graph me-2"></i>Grades</h4>
        <a href="{{ route('teacher.grades.create') }}" class="btn btn-success"><i class="bi bi-plus-lg me-1"></i> Enter
            Grades</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Exam</th>
                        <th>Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $g)
                        <tr>
                            <td class="fw-semibold">{{ $g->student->name ?? '-' }}</td>
                            <td>{{ $g->subject->name ?? '-' }}</td>
                            <td>{{ $g->exam->name ?? '-' }}</td>
                            <td>{{ $g->marks }}</td>
                            <td><span
                                    class="badge bg-{{ $g->grade == 'F' ? 'danger' : ($g->grade == 'A+' || $g->grade == 'A' ? 'success' : 'primary') }}">{{ $g->grade }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No grades entered yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($grades->hasPages())
        <div class="card-footer">{{ $grades->links() }}</div>@endif
    </div>
@endsection
