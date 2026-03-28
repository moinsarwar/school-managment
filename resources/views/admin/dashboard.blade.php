@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2 text-danger"></i>Dashboard</h4>

    <div class="row g-4 mb-4">
        <div class="col-md-4 col-lg">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-building display-5 text-primary"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['classes'] }}</h2>
                <p class="text-muted mb-0">Classes</p>
            </div>
        </div>
        <div class="col-md-4 col-lg">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-person-workspace display-5 text-success"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['teachers'] }}</h2>
                <p class="text-muted mb-0">Teachers</p>
            </div>
        </div>
        <div class="col-md-4 col-lg">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-backpack display-5 text-warning"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['students'] }}</h2>
                <p class="text-muted mb-0">Students</p>
            </div>
        </div>
        <div class="col-md-4 col-lg">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-book display-5 text-info"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['subjects'] }}</h2>
                <p class="text-muted mb-0">Subjects</p>
            </div>
        </div>
        <div class="col-md-4 col-lg">
            <div class="card border-0 shadow-sm text-center p-3">
                <i class="bi bi-file-earmark-text display-5 text-secondary"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['exams'] }}</h2>
                <p class="text-muted mb-0">Exams</p>
            </div>
        </div>
    </div>

    <div class="alert alert-danger bg-danger bg-opacity-10 border-danger">
        <i class="bi bi-check-circle-fill me-2"></i>
        Welcome back, <strong>{{ $user->name }}</strong>! You are logged in as <strong>Admin</strong>.
    </div>
@endsection