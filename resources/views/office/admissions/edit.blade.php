@extends('layouts.office')
@section('title', 'Edit Admission')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Edit Student Record</h4>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('office.admissions.update', $admission) }}">
                @csrf @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Full Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $admission->name) }}"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $admission->email) }}"
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
                            value="{{ old('father_name', $admission->father_name) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control"
                            value="{{ old('date_of_birth', $admission->date_of_birth?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select">
                            <option value="">Select</option>
                            <option value="male" {{ $admission->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $admission->gender == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ $admission->gender == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $admission->phone) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Class</label>
                        <select name="class_id" class="form-select" required>
                            @foreach($classes as $c)<option value="{{ $c->id }}" {{ $admission->class_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Section</label>
                        <select name="section_id" class="form-select" required>
                            @foreach($sections as $s)<option value="{{ $s->id }}" {{ $admission->section_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-semibold">Roll Number</label>
                        <input type="text" name="roll_number" class="form-control"
                            value="{{ old('roll_number', $admission->roll_number) }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="address" class="form-control"
                            rows="2">{{ old('address', $admission->address) }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-info text-white"><i class="bi bi-check-lg me-1"></i> Update</button>
                <a href="{{ route('office.admissions.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </form>
        </div>
    </div>
@endsection