@extends('layouts.admin')
@section('title', 'Student Promotions')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-arrow-up-circle me-2 text-danger"></i>Student Promotions</h4>
    <a href="{{ route('admin.promotions.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> New Promotion</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Student</th><th>From Class</th><th>To Class</th><th>Year</th><th>Status</th><th>Date</th></tr>
            </thead>
            <tbody>
                @forelse($promotions as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ optional($p->student)->name }}</td>
                    <td>{{ optional($p->fromClass)->name }}</td>
                    <td>{{ optional($p->toClass)->name ?? '—' }}</td>
                    <td>{{ $p->academic_year }}</td>
                    <td>
                        @if($p->status === 'promoted') <span class="badge bg-success">Promoted</span>
                        @elseif($p->status === 'retained') <span class="badge bg-warning text-dark">Retained</span>
                        @else <span class="badge bg-info">Graduated</span>
                        @endif
                    </td>
                    <td>{{ $p->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">No promotions recorded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($promotions->hasPages())
    <div class="card-footer">{{ $promotions->links() }}</div>
    @endif
</div>
@endsection
