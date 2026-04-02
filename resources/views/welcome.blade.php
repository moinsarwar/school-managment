@extends('layouts.app')

@section('title', 'School Management System')

@section('content')
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-8 col-lg-6">
                <div class="text-center mb-5">
                    <h1 class="display-4 fw-bold text-primary">
                        <i class="bi bi-mortarboard-fill me-2"></i>School Management
                    </h1>
                    <p class="lead text-muted">Select your role to login</p>
                </div>

                <div class="row g-4">
                    <div class="col-sm-6">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 text-center p-4">
                                <div class="card-body">
                                    <i class="bi bi-shield-lock-fill display-4 text-danger mb-3"></i>
                                    <h5 class="card-title fw-bold">Admin</h5>
                                    <p class="card-text text-muted small">System Administrator</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('teacher.login') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 text-center p-4">
                                <div class="card-body">
                                    <i class="bi bi-person-workspace display-4 text-success mb-3"></i>
                                    <h5 class="card-title fw-bold">Teacher</h5>
                                    <p class="card-text text-muted small">Faculty Member</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('student.login') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 text-center p-4">
                                <div class="card-body">
                                    <i class="bi bi-backpack-fill display-4 text-warning mb-3"></i>
                                    <h5 class="card-title fw-bold">Student</h5>
                                    <p class="card-text text-muted small">Enrolled Student</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('office.login') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 text-center p-4">
                                <div class="card-body">
                                    <i class="bi bi-building-fill display-4 text-info mb-3"></i>
                                    <h5 class="card-title fw-bold">Office</h5>
                                    <p class="card-text text-muted small">Office Staff</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ route('parent.login') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100 text-center p-4">
                                <div class="card-body">
                                    <i class="bi bi-people-fill display-4 text-secondary mb-3"></i>
                                    <h5 class="card-title fw-bold">Parent</h5>
                                    <p class="card-text text-muted small">Guardian / Parent Portal</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection