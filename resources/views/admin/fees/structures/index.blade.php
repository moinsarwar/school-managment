@extends('layouts.admin')
@section('title', 'Fee Structures')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-currency-dollar me-2 text-danger"></i>Fee Structures</h4>
    <a href="{{ route('admin.fee-structures.create') }}" class="btn btn-danger">
        <i class="bi bi-plus-lg me-1"></i> Add Structure
    </a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr><th>#</th><th>Class</th><th>Fee Type</th><th>Amount (PKR)</th><th>Description</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($structures as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ optional($s->schoolClass)->name }}</td>
                    <td><span class="badge bg-secondary text-capitalize">{{ $s->fee_type }}</span></td>
                    <td>{{ number_format($s->amount, 2) }}</td>
                    <td>{{ $s->description ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.fee-structures.edit', $s) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.fee-structures.destroy', $s) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No fee structures defined yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($structures->hasPages())
    <div class="card-footer">{{ $structures->links() }}</div>
    @endif
</div>
@endsection
