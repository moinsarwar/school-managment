<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Exam;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('admin')->user();
        $stats = [
            'classes' => SchoolClass::count(),
            'teachers' => Teacher::count(),
            'students' => Student::count(),
            'subjects' => Subject::count(),
            'exams' => Exam::count(),
        ];
        return view('admin.dashboard', compact('user', 'stats'));
    }
}
