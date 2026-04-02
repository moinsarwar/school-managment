<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        $leaves  = Leave::where('user_type', 'teacher')
            ->where('user_id', $teacher->id)
            ->orderBy('id', 'desc')
            ->paginate(15);
        return view('teacher.leaves.index', compact('leaves'));
    }

    public function create()
    {
        return view('teacher.leaves.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date'   => 'required|date|after_or_equal:from_date',
            'reason'    => 'required|string|max:1000',
        ]);

        $teacher = Auth::guard('teacher')->user();

        Leave::create([
            'user_type' => 'teacher',
            'user_id'   => $teacher->id,
            'from_date' => $request->from_date,
            'to_date'   => $request->to_date,
            'reason'    => $request->reason,
            'status'    => 'pending',
        ]);

        return redirect()->route('teacher.leaves.index')
            ->with('success', 'Leave application submitted successfully.');
    }
}
