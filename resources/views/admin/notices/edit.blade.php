@extends('layouts.admin')
@section('title', 'Edit Notice')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-pencil me-2 text-danger"></i>Edit Notice</h4>
    <a href="{{ route('admin.notices.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
</div>
<div class="card shadow-sm" style="max-width:700px;">
    <div class="card-body">
        @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif
        <form method="POST" action="{{ route('admin.notices.update', $notice) }}">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $notice->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Body</label>
                <textarea name="body" class="form-control" rows="5" required>{{ old('body', $notice->body) }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Target</label>
                    <select name="target" class="form-select" required>
                        @foreach(['all','teachers','students','parents','office'] as $t)
                            <option value="{{ $t }}" {{ old('target', $notice->target)==$t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Publish Date</label>
                    <input type="date" name="published_at" class="form-control" value="{{ old('published_at', optional($notice->published_at)->format('Y-m-d')) }}">
                </div>
            </div>
            <button type="submit" class="btn btn-danger px-4"><i class="bi bi-check-lg me-1"></i> Update</button>
        </form>
    </div>
</div>
@endsection
