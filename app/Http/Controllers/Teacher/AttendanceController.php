<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        $attendances = Attendance::with('student')
            ->where('marked_by', $teacher->id)
            ->latest('date')
            ->paginate(50);
        return view('teacher.attendance.index', compact('attendances'));
    }

    public function create()
    {
        $teacher = Auth::guard('teacher')->user();
        if (!$teacher->class_id) {
            return redirect()->route('teacher.attendance.index')->with('error', 'No class assigned to you. Contact admin.');
        }
        $students = Student::where('class_id', $teacher->class_id)->orderBy('roll_number')->get();
        $today = now()->format('Y-m-d');
        $existing = Attendance::where('class_id', $teacher->class_id)->where('date', $today)->pluck('status', 'student_id');
        return view('teacher.attendance.create', compact('students', 'today', 'existing'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::guard('teacher')->user();
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent,late',
        ]);

        foreach ($request->attendance as $studentId => $status) {
            Attendance::updateOrCreate(
                ['student_id' => $studentId, 'date' => $request->date],
                ['class_id' => $teacher->class_id, 'status' => $status, 'marked_by' => $teacher->id]
            );
        }

        return redirect()->route('teacher.attendance.index')->with('success', 'Attendance marked successfully for ' . $request->date);
    }
}
