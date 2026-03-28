@extends('layouts.admin')
@section('title', 'Edit Subject')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Subject</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.subjects.update', $subject) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-semibold">Class</label>
                    <select name="class_id" class="form-select" required>
                        @foreach($classes as $c)<option value="{{ $c->id }}" {{ $subject->class_id == $c->id ? 'selected' : '' }}>
                        {{ $c->name }}</option>@endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Subject Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $subject->name) }}" required>
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection