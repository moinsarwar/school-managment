@extends('layouts.office')
@section('title', 'Admissions')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-person-plus me-2"></i>Admissions</h4>
        <a href="{{ route('office.admissions.create') }}" class="btn btn-info text-white"><i class="bi bi-plus-lg me-1"></i>
            New Admission</a>
    </div>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0 dt-table">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Roll</th>
                        <th>Admission Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $i => $s)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $s->name }}</td>
                            <td>{{ $s->schoolClass->name ?? '-' }}</td>
                            <td>{{ $s->section->name ?? '-' }}</td>
                            <td>{{ $s->roll_number ?? '-' }}</td>
                            <td>{{ $s->admission_date ? \Carbon\Carbon::parse($s->admission_date)->format('d M Y') : '-' }}</td>
                            <td><a href="{{ route('office.admissions.edit', $s) }}" class="btn btn-sm btn-outline-primary"><i
                                        class="bi bi-pencil"></i></a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No admissions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
