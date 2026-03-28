@extends('layouts.admin')
@section('title', 'Manage Teachers')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-person-workspace me-2"></i>Teachers</h4>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add
            Teacher</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($teachers as $i => $t)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $t->name }}</td>
                            <td>{{ $t->email }}</td>
                            <td>{{ $t->phone ?? '-' }}</td>
                            <td>{{ $t->schoolClass->name ?? '-' }}</td>
                            <td>{{ $t->subject->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.teachers.edit', $t) }}" class="btn btn-sm btn-outline-primary me-1"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.teachers.destroy', $t) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No teachers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection