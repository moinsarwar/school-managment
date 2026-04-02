@extends('layouts.parent')
@section('title', 'Parent Dashboard')
@section('content')
<div class="mb-4">
    <h4><i class="bi bi-speedometer2 me-2 text-info"></i>Welcome, {{ $parent->name }}</h4>
    <p class="text-muted">Here's an overview of your children's school status.</p>
</div>

<div class="row g-4 mb-4">
    @foreach($children as $child)
    <div class="col-md-6">
        <div class="card shadow-sm border-start border-info border-4">
            <div class="card-body">
                <h5 class="fw-bold mb-1">{{ $child->name }}</h5>
                <p class="text-muted small mb-3">
                    Class: <strong>{{ optional($child->schoolClass)->name }}</strong>
                    &nbsp;|&nbsp; Section: <strong>{{ optional($child->section)->name }}</strong>
                    &nbsp;|&nbsp; Roll: <strong>{{ $child->roll_no ?? 'N/A' }}</strong>
                </p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('parent.child.attendance', $child->id) }}" class="btn btn-sm btn-outline-info">
                        <i class="bi bi-clipboard-check me-1"></i> Attendance
                    </a>
                    <a href="{{ route('parent.child.results', $child->id) }}" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-bar-chart me-1"></i> Results
                    </a>
                    <a href="{{ route('parent.child.fees', $child->id) }}" class="btn btn-sm btn-outline-warning">
                        <i class="bi bi-cash me-1"></i> Fee Status
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if($children->isEmpty())
    <div class="col-12">
        <div class="alert alert-info">No children linked to your account yet. Please contact the school administration.</div>
    </div>
    @endif
</div>

<div class="row g-4">
    {{-- Notices --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header fw-bold"><i class="bi bi-megaphone me-2 text-info"></i>Latest Notices</div>
            <div class="card-body p-0">
                @forelse($notices as $notice)
                <div class="px-3 py-2 border-bottom">
                    <div class="fw-semibold">{{ $notice->title }}</div>
                    <div class="small text-muted">{{ Str::limit($notice->body, 80) }}</div>
                </div>
                @empty
                <p class="text-muted p-3">No notices at this time.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Events --}}
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header fw-bold"><i class="bi bi-calendar-event me-2 text-info"></i>Upcoming Events</div>
            <div class="card-body p-0">
                @forelse($events as $event)
                <div class="px-3 py-2 border-bottom d-flex justify-content-between">
                    <div>
                        <div class="fw-semibold">{{ $event->title }}</div>
                        <span class="badge bg-secondary small">{{ ucfirst($event->type) }}</span>
                    </div>
                    <div class="text-muted small">{{ $event->event_date->format('d M') }}</div>
                </div>
                @empty
                <p class="text-muted p-3">No upcoming events.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
