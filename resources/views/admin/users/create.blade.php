@extends('layouts.admin')
@section('title', 'Add User')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-person-plus me-2 text-danger"></i>Add New User</h4>
    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Back
    </a>
</div>

<div class="card shadow-sm" style="max-width:700px;">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                <select name="role" id="roleSelect" class="form-select" required onchange="toggleFields()">
                    <option value="">-- Select Role --</option>
                    <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    <option value="teacher" {{ old('role')=='teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="student" {{ old('role')=='student' ? 'selected' : '' }}>Student</option>
                    <option value="parent" {{ old('role')=='parent' ? 'selected' : '' }}>Parent</option>
                    <option value="office" {{ old('role')=='office' ? 'selected' : '' }}>Office Staff</option>
                </select>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Confirm Password <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            {{-- Teacher fields --}}
            <div id="teacherFields" style="display:none;">
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Subject</label>
                        <select name="subject_id" class="form-select">
                            <option value="">-- None --</option>
                            @foreach($subjects as $s)
                                <option value="{{ $s->id }}" {{ old('subject_id')==$s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Class</label>
                        <select name="class_id" class="form-select">
                            <option value="">-- None --</option>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}" {{ old('class_id')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Student fields --}}
            <div id="studentFields" style="display:none;">
                <hr>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Class <span class="text-danger">*</span></label>
                        <select name="class_id" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}" {{ old('class_id')==$c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Section <span class="text-danger">*</span></label>
                        <select name="section_id" class="form-select">
                            <option value="">-- Select --</option>
                            @foreach($sections as $s)
                                <option value="{{ $s->id }}" {{ old('section_id')==$s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Roll No</label>
                        <input type="text" name="roll_no" class="form-control" value="{{ old('roll_no') }}">
                    </div>
                </div>
            </div>

            <div class="mt-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="bi bi-check-lg me-1"></i> Create User
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleFields() {
    const role = document.getElementById('roleSelect').value;
    document.getElementById('teacherFields').style.display = role === 'teacher' ? '' : 'none';
    document.getElementById('studentFields').style.display = role === 'student' ? '' : 'none';
}
document.addEventListener('DOMContentLoaded', toggleFields);
</script>
@endsection
