@extends('layouts.parent')
@section('title', $student->name . ' - Results')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-bar-chart me-2 text-info"></i>{{ $student->name }} — Exam Results</h4>
    <a href="{{ route('parent.dashboard') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-dark"><tr><th>Exam</th><th>Subject</th><th>Marks</th><th>Grade</th></tr></thead>
            <tbody>
                @forelse($grades as $g)
                <tr>
                    <td>{{ optional($g->exam)->title ?? '—' }}</td>
                    <td>{{ optional($g->subject)->name ?? '—' }}</td>
                    <td>{{ $g->marks }}</td>
                    <td><span class="badge bg-primary">{{ $g->grade ?? '—' }}</span></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No results found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

