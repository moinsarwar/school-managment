@extends('layouts.admin')
@section('title', 'Edit Student')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Student</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.students.update', $student) }}">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $student->email) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Password <small class="text-muted">(leave blank to
                                keep)</small></label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Father's Name</label>
                        <input type="text" name="father_name" class="form-control"
                            value="{{ old('father_name', $student->father_name) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male" {{ $student->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $student->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $student->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $student->phone) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Class</label>
                        <select name="class_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($classes as $c)<option value="{{ $c->id }}" {{ $student->class_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Section</label>
                        <select name="section_id" class="form-select">
                            <option value="">Select</option>
                            @foreach($sections as $s)<option value="{{ $s->id }}" {{ $student->section_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Roll Number</label>
                        <input type="text" name="roll_number" class="form-control"
                            value="{{ old('roll_number', $student->roll_number) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Admission Date</label>
                        <input type="date" name="admission_date" class="form-control"
                            value="{{ old('admission_date', $student->admission_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control"
                            rows="2">{{ old('address', $student->address) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection