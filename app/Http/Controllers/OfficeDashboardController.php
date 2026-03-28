<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class OfficeDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('office')->user();
        $stats = [
            'total_students' => Student::count(),
            'recent_admissions' => Student::where('admission_date', '>=', now()->subDays(30))->count(),
        ];
        return view('office.dashboard', compact('user', 'stats'));
    }
}
