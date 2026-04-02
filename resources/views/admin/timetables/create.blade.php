@extends('layouts.admin')
@section('title', 'Add Timetable Slot')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-plus me-2 text-danger"></i>Add Timetable Slot</h4>
    <a href="{{ route('admin.timetables.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm" style="max-width:650px;">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.timetables.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Class <span class="text-danger">*</span></label>
                    <select name="class_id" class="form-select" required>
                        <option value="">-- Select --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}" {{ old('class_id')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Section <span class="text-danger">*</span></label>
                    <select name="section_id" class="form-select" required>
                        <option value="">-- Select --</option>
                        @foreach($sections as $s)
                            <option value="{{ $s->id }}" {{ old('section_id')==$s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Day <span class="text-danger">*</span></label>
                    <select name="day" class="form-select" required>
                        <option value="">-- Select Day --</option>
                        @foreach($days as $d)
                            <option value="{{ $d }}" {{ old('day')==$d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Period # <span class="text-danger">*</span></label>
                    <input type="number" name="period" class="form-control" min="1" max="10" value="{{ old('period') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Subject <span class="text-danger">*</span></label>
                    <select name="subject_id" class="form-select" required>
                        <option value="">-- Select --</option>
                        @foreach($subjects as $s)
                            <option value="{{ $s->id }}" {{ old('subject_id')==$s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Teacher</label>
                    <select name="teacher_id" class="form-select">
                        <option value="">-- None --</option>
                        @foreach($teachers as $t)
                            <option value="{{ $t->id }}" {{ old('teacher_id')==$t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Start Time</label>
                    <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">End Time</label>
                    <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
                </div>
            </div>
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i> Add Slot</button>
        </form>
    </div>
</div>
@endsection
