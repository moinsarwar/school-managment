@extends('layouts.admin')
@section('title', 'Edit Class')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Class</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.classes.update', $class) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Class Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $class->name) }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection