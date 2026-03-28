<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use App\Models\Grade;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('student')->user();
        $stats = [
            'class' => $user->schoolClass ? $user->schoolClass->name : 'Not Assigned',
            'section' => $user->section ? $user->section->name : 'N/A',
            'total_attendance' => Attendance::where('student_id', $user->id)->count(),
            'present_days' => Attendance::where('student_id', $user->id)->where('status', 'present')->count(),
        ];
        return view('student.dashboard', compact('user', 'stats'));
    }

    public function attendance()
    {
        $user = Auth::guard('student')->user();
        $attendances = Attendance::where('student_id', $user->id)->latest('date')->paginate(30);
        return view('student.attendance', compact('user', 'attendances'));
    }

    public function results()
    {
        $user = Auth::guard('student')->user();
        $grades = Grade::with(['subject', 'exam'])->where('student_id', $user->id)->latest()->get();
        return view('student.results', compact('user', 'grades'));
    }
}
