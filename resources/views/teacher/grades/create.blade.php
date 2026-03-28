@extends('layouts.teacher')
@section('title', 'Enter Grades')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-pencil me-2"></i>Enter Grades</h4>

    @if($students->isEmpty())
        <div class="alert alert-warning">No students found in your assigned class.</div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <form method="POST" action="{{ route('teacher.grades.store') }}">
                    @csrf
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Select Exam</label>
                            <select name="exam_id" class="form-select @error('exam_id') is-invalid @enderror" required>
                                <option value="">Select Exam</option>
                                @foreach($exams as $e)<option value="{{ $e->id }}" {{ old('exam_id') == $e->id ? 'selected' : '' }}>
                                {{ $e->name }}</option>@endforeach
                            </select>
                            @error('exam_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Select Subject</label>
                            <select name="subject_id" class="form-select @error('subject_id') is-invalid @enderror" required>
                                <option value="">Select Subject</option>
                                @foreach($subjects as $sub)<option value="{{ $sub->id }}" {{ old('subject_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>@endforeach
                            </select>
                            @error('subject_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <table class="table table-hover mb-3">
                        <thead class="table-light">
                            <tr>
                                <th>Roll</th>
                                <th>Student</th>
                                <th>Marks (0-100)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $s)
                                <tr>
                                    <td>{{ $s->roll_number ?? '-' }}</td>
                                    <td class="fw-semibold">{{ $s->name }}</td>
                                    <td><input type="number" name="grades[{{ $s->id }}][marks]" class="form-control" min="0"
                                            max="100" step="0.01" value="{{ old("grades.{$s->id}.marks", '') }}" required
                                            style="width:120px"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success"><i class="bi bi-check-lg me-1"></i> Save Grades</button>
                    <a href="{{ route('teacher.grades.index') }}" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    @endif
@endsection