@extends('layouts.office')
@section('title', 'Office Dashboard')
@section('content')
    <h4 class="fw-bold mb-4"><i class="bi bi-speedometer2 me-2 text-info"></i>Dashboard</h4>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm text-center p-4">
                <i class="bi bi-people display-4 text-primary"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['total_students'] }}</h2>
                <p class="text-muted mb-0">Total Students</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm text-center p-4">
                <i class="bi bi-person-plus display-4 text-success"></i>
                <h2 class="fw-bold mt-2 mb-0">{{ $stats['recent_admissions'] }}</h2>
                <p class="text-muted mb-0">Recent Admissions (30 days)</p>
            </div>
        </div>
    </div>

    <div class="alert alert-info bg-info bg-opacity-10 border-info">
        <i class="bi bi-check-circle-fill me-2"></i>
        Welcome back, <strong>{{ $user->name }}</strong>! You are logged in as <strong>Office Staff</strong>.
    </div>
@endsection