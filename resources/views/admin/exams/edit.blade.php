@extends('layouts.admin')
@section('title', 'Edit Exam')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Exam</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.exams.update', $exam) }}">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Exam Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $exam->name) }}" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Class</label>
                        <select name="class_id" class="form-select" required>
                            @foreach($classes as $c)<option value="{{ $c->id }}" {{ $exam->class_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label fw-semibold">Date</label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $exam->date) }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection