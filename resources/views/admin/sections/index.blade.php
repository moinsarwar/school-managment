@extends('layouts.admin')
@section('title', 'Manage Sections')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-grid me-2"></i>Sections</h4>
        <a href="{{ route('admin.sections.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add
            Section</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sections as $i => $section)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $section->name }}</td>
                            <td>{{ $section->schoolClass->name ?? '-' }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $section->students_count }}</span></td>
                            <td>
                                <a href="{{ route('admin.sections.edit', $section) }}"
                                    class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.sections.destroy', $section) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No sections found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
