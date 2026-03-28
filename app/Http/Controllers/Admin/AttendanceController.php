<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classes = SchoolClass::all();
        $query = Attendance::with(['student', 'schoolClass', 'teacher']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
        if ($request->filled('date')) {
            $query->where('date', $request->date);
        }

        $attendances = $query->latest('date')->paginate(50);
        return view('admin.attendance.index', compact('attendances', 'classes'));
    }
}
