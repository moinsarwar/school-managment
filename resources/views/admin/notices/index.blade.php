@extends('layouts.admin')
@section('title', 'Notice Board')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-megaphone me-2 text-danger"></i>Notice Board</h4>
    <a href="{{ route('admin.notices.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add Notice</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Title</th><th>Target</th><th>Published</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($notices as $n)
                <tr>
                    <td>{{ $n->id }}</td>
                    <td>{{ $n->title }}</td>
                    <td><span class="badge bg-info text-dark">{{ ucfirst($n->target) }}</span></td>
                    <td>{{ $n->published_at ? $n->published_at->format('d M Y') : '—' }}</td>
                    <td>
                        <a href="{{ route('admin.notices.edit', $n) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.notices.destroy', $n) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">No notices yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($notices->hasPages())
    <div class="card-footer">{{ $notices->links() }}</div>
    @endif
</div>
@endsection
