@extends('layouts.student')
@section('title', 'My Results')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-bar-chart me-2"></i>My Results</h4>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>Exam</th>
                        <th>Subject</th>
                        <th>Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($grades as $g)
                        <tr>
                            <td>{{ $g->exam->name ?? '-' }}</td>
                            <td class="fw-semibold">{{ $g->subject->name ?? '-' }}</td>
                            <td>{{ $g->marks }}</td>
                            <td><span
                                    class="badge bg-{{ $g->grade == 'F' ? 'danger' : ($g->grade == 'A+' || $g->grade == 'A' ? 'success' : 'primary') }}">{{ $g->grade }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No results available yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
