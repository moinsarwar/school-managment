@extends('layouts.admin')
@section('title', 'Promote Students')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-arrow-up-circle me-2 text-danger"></i>Promote / Retain Students</h4>
    <a href="{{ route('admin.promotions.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>

{{-- Step 1: Select class --}}
<div class="card shadow-sm mb-4" style="max-width:500px;">
    <div class="card-body">
        <h6 class="fw-bold mb-3">Step 1: Select Class</h6>
        <form method="GET">
            <div class="d-flex gap-2">
                <select name="class_id" class="form-select" required>
                    <option value="">-- Select Class --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ request('class_id')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Load Students</button>
            </div>
        </form>
    </div>
</div>

@if($fromClass && $students->isNotEmpty())
<div class="card shadow-sm" style="max-width:800px;">
    <div class="card-header fw-bold">
        Step 2: Promote Students of {{ $fromClass->name }}
    </div>
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.promotions.store') }}">
            @csrf
            <input type="hidden" name="from_class_id" value="{{ $fromClass->id }}">

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Promote To Class</label>
                    <select name="to_class_id" class="form-select">
                        <option value="">-- Same / Graduate --</option>
                        @foreach($classes as $c)
                            @if($c->id !== $fromClass->id)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Academic Year <span class="text-danger">*</span></label>
                    <input type="text" name="academic_year" class="form-control" value="{{ date('Y') . '-' . (date('Y')+1) }}" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="promoted">Promoted</option>
                        <option value="retained">Retained</option>
                        <option value="graduated">Graduated</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Select Students</label>
                <div class="mb-1">
                    <a href="#" onclick="document.querySelectorAll('.stu-check').forEach(c=>c.checked=true);return false;" class="small me-2">Select All</a>
                    <a href="#" onclick="document.querySelectorAll('.stu-check').forEach(c=>c.checked=false);return false;" class="small">Deselect All</a>
                </div>
                <div class="border rounded p-2" style="max-height:300px;overflow-y:auto;">
                    @foreach($students as $s)
                    <div class="form-check">
                        <input class="form-check-input stu-check" type="checkbox" name="student_ids[]" value="{{ $s->id }}" id="stu_{{ $s->id }}" checked>
                        <label class="form-check-label" for="stu_{{ $s->id }}">{{ $s->name }} (Roll: {{ $s->roll_no ?? 'N/A' }})</label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Remarks</label>
                <input type="text" name="remarks" class="form-control" placeholder="Optional...">
            </div>

            <button type="submit" class="btn btn-danger px-4">
                <i class="bi bi-check-lg me-1"></i> Process Promotions
            </button>
        </form>
    </div>
</div>
@elseif($fromClass)
<div class="alert alert-warning">No students found in {{ $fromClass->name }}.</div>
@endif
@endsection
