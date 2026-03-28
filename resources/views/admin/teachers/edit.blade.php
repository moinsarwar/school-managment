@extends('layouts.admin')
@section('title', 'Edit Teacher')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Teacher</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.teachers.update', $teacher) }}">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $teacher->name) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $teacher->email) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Password <small class="text-muted">(leave blank to
                                keep)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $teacher->phone) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Qualification</label>
                        <input type="text" name="qualification" class="form-control"
                            value="{{ old('qualification', $teacher->qualification) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Assigned Class</label>
                        <select name="class_id" class="form-select">
                            <option value="">None</option>
                            @foreach($classes as $c)<option value="{{ $c->id }}" {{ $teacher->class_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Assigned Subject</label>
                        <select name="subject_id" class="form-select">
                            <option value="">None</option>
                            @foreach($subjects as $s)<option value="{{ $s->id }}" {{ $teacher->subject_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control"
                            rows="2">{{ old('address', $teacher->address) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection