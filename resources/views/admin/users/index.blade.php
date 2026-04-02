@extends('layouts.admin')
@section('title', 'User Management')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-people me-2 text-danger"></i>User Management</h4>
    <a href="{{ route('admin.users.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-lg me-1"></i> Add User
    </a>
</div>

<ul class="nav nav-tabs mb-4" id="userTabs">
    <li class="nav-item"><a class="nav-link {{ !request('tab') || request('tab')=='admin' ? 'active' : '' }}" href="?tab=admin">Admins ({{ $admins->count() }})</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab')=='teacher' ? 'active' : '' }}" href="?tab=teacher">Teachers ({{ $teachers->count() }})</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab')=='student' ? 'active' : '' }}" href="?tab=student">Students ({{ $students->count() }})</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab')=='office' ? 'active' : '' }}" href="?tab=office">Office Staff ({{ $offices->count() }})</a></li>
</ul>

@php $tab = request('tab', 'admin'); @endphp

@if($tab === 'admin')
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark"><tr><th>#</th><th>Name</th><th>Email</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($admins as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['admin', $u->id]) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.users.destroy', ['admin', $u->id]) }}" class="d-inline" onsubmit="return confirm('Delete this admin?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">No admins found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@elseif($tab === 'teacher')
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark"><tr><th>#</th><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($teachers as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['teacher', $u->id]) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.users.destroy', ['teacher', $u->id]) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">No teachers found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@elseif($tab === 'student')
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark"><tr><th>#</th><th>Name</th><th>Email</th><th>Class</th><th>Roll No</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($students as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ optional($u->schoolClass)->name }} {{ optional($u->section)->name }}</td>
                    <td>{{ $u->roll_no ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['student', $u->id]) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.users.destroy', ['student', $u->id]) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted">No students found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@elseif($tab === 'office')
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark"><tr><th>#</th><th>Name</th><th>Email</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse($offices as $u)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', ['office', $u->id]) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.users.destroy', ['office', $u->id]) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" class="text-center text-muted">No office staff found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
