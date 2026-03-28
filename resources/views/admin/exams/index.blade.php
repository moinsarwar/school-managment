@extends('layouts.admin')
@section('title', 'Manage Exams')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-file-earmark-text me-2"></i>Exams</h4>
        <a href="{{ route('admin.exams.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add Exam</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($exams as $i => $exam)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $exam->name }}</td>
                            <td>{{ $exam->schoolClass->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($exam->date)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('admin.exams.edit', $exam) }}" class="btn btn-sm btn-outline-primary me-1"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No exams found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection