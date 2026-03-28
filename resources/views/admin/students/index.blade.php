@extends('layouts.admin')
@section('title', 'Manage Students')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-backpack me-2"></i>Students</h4>
        <a href="{{ route('admin.students.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add
            Student</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Roll</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $s->roll_number ?? '-' }}</td>
                            <td class="fw-semibold">{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->schoolClass->name ?? '-' }}</td>
                            <td>{{ $s->section->name ?? '-' }}</td>
                            <td>{{ ucfirst($s->gender ?? '-') }}</td>
                            <td>
                                <a href="{{ route('admin.students.edit', $s) }}" class="btn btn-sm btn-outline-primary me-1"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.students.destroy', $s) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection