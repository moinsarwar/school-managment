<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Attendance;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('teacher')->user();
        $stats = [
            'students' => $user->class_id ? Student::where('class_id', $user->class_id)->count() : 0,
            'class' => $user->schoolClass ? $user->schoolClass->name : 'Not Assigned',
            'subject' => $user->subject ? $user->subject->name : 'Not Assigned',
            'attendance_today' => $user->class_id ? Attendance::where('class_id', $user->class_id)->where('date', today())->count() : 0,
        ];
        return view('teacher.dashboard', compact('user', 'stats'));
    }
}
