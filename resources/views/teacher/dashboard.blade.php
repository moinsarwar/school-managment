@extends('layouts.teacher')
@section('title', 'Teacher Dashboard')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2 text-success"></i>Dashboard</h4>

    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-building display-5 text-primary"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $stats['class'] }}</h4>
                <p class="text-muted mb-0">Assigned Class</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-book display-5 text-info"></i>
                <h4 class="fw-bold mt-2 mb-0">{{ $stats['subject'] }}</h4>
                <p class="text-muted mb-0">Assigned Subject</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-people display-5 text-warning"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['students'] }}</h2>
                <p class="text-muted mb-0">Students</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-clipboard-check display-5 text-success"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['attendance_today'] }}</h2>
                <p class="text-muted mb-0">Attendance Today</p>
            </div>
        </div>
    </div>

    <div class="alert alert-success bg-success bg-opacity-10 border-success">
        <i class="bi bi-check-circle-fill me-2"></i>
        Welcome back, <strong>{{ $user->name }}</strong>! You are logged in as a <strong>Teacher</strong>.
    </div>
@endsection