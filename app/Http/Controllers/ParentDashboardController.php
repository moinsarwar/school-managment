<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\FeePayment;
use App\Models\Notice;
use App\Models\Event;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $parent   = Auth::guard('parent')->user();
        $children = $parent->students()->with(['schoolClass', 'section'])->get();

        $notices = Notice::where('target', 'parents')
            ->orWhere('target', 'all')
            ->latest()
            ->take(5)
            ->get();

        $events = Event::where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        return view('parent.dashboard', compact('parent', 'children', 'notices', 'events'));
    }

    public function childAttendance($studentId)
    {
        $parent  = Auth::guard('parent')->user();
        $student = $parent->students()->findOrFail($studentId);

        $attendance = Attendance::where('student_id', $studentId)
            ->orderBy('date', 'desc')
            ->paginate(30);

        return view('parent.child_attendance', compact('student', 'attendance'));
    }

    public function childResults($studentId)
    {
        $parent  = Auth::guard('parent')->user();
        $student = $parent->students()->findOrFail($studentId);

        $grades = Grade::where('student_id', $studentId)
            ->with(['exam', 'subject'])
            ->orderBy('id', 'desc')
            ->get();

        return view('parent.child_results', compact('student', 'grades'));
    }

    public function childFees($studentId)
    {
        $parent  = Auth::guard('parent')->user();
        $student = $parent->students()->findOrFail($studentId);

        $payments = FeePayment::where('student_id', $studentId)
            ->with('feeStructure')
            ->orderBy('id', 'desc')
            ->paginate(15);

        return view('parent.child_fees', compact('student', 'payments'));
    }
}
