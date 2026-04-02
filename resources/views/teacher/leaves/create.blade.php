@extends('layouts.teacher')
@section('title', 'Apply for Leave')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-plus me-2 text-primary"></i>Apply for Leave</h4>
    <a href="{{ route('teacher.leaves.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm" style="max-width:600px;">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('teacher.leaves.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">From Date <span class="text-danger">*</span></label>
                    <input type="date" name="from_date" class="form-control" value="{{ old('from_date') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">To Date <span class="text-danger">*</span></label>
                    <input type="date" name="to_date" class="form-control" value="{{ old('to_date') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Reason <span class="text-danger">*</span></label>
                <textarea name="reason" class="form-control" rows="4" required>{{ old('reason') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary px-4"><i class="bi bi-send me-1"></i> Submit Application</button>
        </form>
    </div>
</div>
@endsection
