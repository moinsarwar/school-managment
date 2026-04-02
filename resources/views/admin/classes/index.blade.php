@extends('layouts.admin')
@section('title', 'Manage Classes')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-building me-2"></i>Classes</h4>
        <a href="{{ route('admin.classes.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add
            Class</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Sections</th>
                        <th>Subjects</th>
                        <th>Students</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($classes as $i => $class)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $class->name }}</td>
                            <td><span class="badge bg-primary">{{ $class->sections_count }}</span></td>
                            <td><span class="badge bg-info">{{ $class->subjects_count }}</span></td>
                            <td><span class="badge bg-warning text-dark">{{ $class->students_count }}</span></td>
                            <td>
                                <a href="{{ route('admin.classes.edit', $class) }}"
                                    class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this class?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No classes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
