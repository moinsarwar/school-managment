@extends('layouts.admin')
@section('title', 'Add Class')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-plus-lg me-2"></i>Add Class</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.classes.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-semibold">Class Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="e.g. Class 1" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Save</button>
                <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection