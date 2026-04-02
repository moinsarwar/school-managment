@extends('layouts.admin')
@section('title', 'Timetable')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0"><i class="bi bi-calendar3-week me-2 text-danger"></i>Timetable</h4>
    <a href="{{ route('admin.timetables.create') }}" class="btn btn-danger"><i class="bi bi-plus-lg me-1"></i> Add Slot</a>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-auto">
                <select name="class_id" class="form-select form-select-sm" required>
                    <option value="">-- Select Class --</option>
                    @foreach($classes as $c)
                        <option value="{{ $c->id }}" {{ $classId == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select name="section_id" class="form-select form-select-sm" required>
                    <option value="">-- Select Section --</option>
                    @foreach($sections as $s)
                        <option value="{{ $s->id }}" {{ $sectionId == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button class="btn btn-sm btn-primary">View</button>
            </div>
        </form>
    </div>
</div>

@if($timetable->isNotEmpty())
<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-bordered table-sm mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Period</th>
                    @foreach($days as $day) <th>{{ $day }}</th> @endforeach
                </tr>
            </thead>
            <tbody>
                @for($p = 1; $p <= 8; $p++)
                <tr>
                    <td class="fw-bold text-center">P{{ $p }}</td>
                    @foreach($days as $day)
                        <td>
                            @php $slot = $timetable->get($day, collect())->firstWhere('period', $p); @endphp
                            @if($slot)
                                <div class="small">
                                    <strong>{{ optional($slot->subject)->name }}</strong><br>
                                    <span class="text-muted">{{ optional($slot->teacher)->name ?? '—' }}</span><br>
                                    @if($slot->start_time)<span class="text-muted">{{ \Carbon\Carbon::parse($slot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($slot->end_time)->format('H:i') }}</span>@endif
                                </div>
                                <div class="mt-1">
                                    <a href="{{ route('admin.timetables.edit', $slot) }}" class="btn btn-xs btn-outline-primary btn-sm py-0 px-1"><i class="bi bi-pencil"></i></a>
                                    <form method="POST" action="{{ route('admin.timetables.destroy', $slot) }}" class="d-inline" onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-xs btn-outline-danger btn-sm py-0 px-1"><i class="bi bi-trash"></i></button>
                                    </form>
                                </div>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                    @endforeach
                </tr>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@elseif($classId && $sectionId)
<div class="alert alert-info">No timetable entries found for this class/section. <a href="{{ route('admin.timetables.create') }}">Add some.</a></div>
@endif
@endsection
