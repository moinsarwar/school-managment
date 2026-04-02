@extends('layouts.admin')
@section('title', 'Events / Calendar')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar-event me-2 text-danger"></i>Academic Calendar & Events</h4>
    <a href="{{ route('admin.events.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add Event</a>
</div>
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 dt-table">
            <thead class="table-dark">
                <tr><th>#</th><th>Title</th><th>Type</th><th>Date</th><th>Description</th><th>Actions</th></tr>
            </thead>
            <tbody>
                @forelse($events as $e)
                <tr>
                    <td>{{ $e->id }}</td>
                    <td>{{ $e->title }}</td>
                    <td>
                        @php $colors = ['holiday'=>'success','exam'=>'danger','meeting'=>'warning','event'=>'primary','other'=>'secondary']; @endphp
                        <span class="badge bg-{{ $colors[$e->type] ?? 'secondary' }}">{{ ucfirst($e->type) }}</span>
                    </td>
                    <td>{{ $e->event_date->format('d M Y') }}</td>
                    <td>{{ Str::limit($e->description, 40) ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $e) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.events.destroy', $e) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No events scheduled.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

