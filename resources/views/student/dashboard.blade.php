@extends('layouts.student')
@section('title', 'Student Dashboard')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2 text-warning"></i>Dashboard</h4>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-building display-5 text-primary"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $stats['class'] }}</h4>
                <p class="text-muted mb-0">Class</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-grid display-5 text-info"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $stats['section'] }}</h4>
                <p class="text-muted mb-0">Section</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-clipboard-check display-5 text-success"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['present_days'] }}/{{ $stats['total_attendance'] }}</h2>
                <p class="text-muted mb-0">Attendance</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-person-badge display-5 text-warning"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $user->roll_number ?? 'N/A' }}</h4>
                <p class="text-muted mb-0">Roll Number</p>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning bg-opacity-10 fw-semibold"><i class="bi bi-person-circle me-2"></i>My Profile
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2"><strong>Name:</strong> {{ $user->name }}</div>
                <div class="col-md-6 mb-2"><strong>Email:</strong> {{ $user->email }}</div>
                <div class="col-md-6 mb-2"><strong>Father's Name:</strong> {{ $user->father_name ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Phone:</strong> {{ $user->phone ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Date of Birth:</strong>
                    {{ $user->date_of_birth?->format('d M Y') ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Gender:</strong> {{ ucfirst($user->gender ?? '-') }}</div>
                <div class="col-md-6 mb-2"><strong>Admission Date:</strong>
                    {{ $user->admission_date?->format('d M Y') ?? '-' }}</div>
                <div class="col-md-6 mb-2"><strong>Address:</strong> {{ $user->address ?? '-' }}</div>
            </div>
        </div>
    </div>
@endsection