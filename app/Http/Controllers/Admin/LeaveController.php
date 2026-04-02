<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leave;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    public function index(Request $request)
    {
        $query = Leave::orderBy('id', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('user_type')) {
            $query->where('user_type', $request->user_type);
        }

        $leaves = $query->paginate(20);

        // Attach user name
        $leaves->getCollection()->transform(function ($leave) {
            $leave->user_name = $leave->user_type === 'teacher'
                ? optional(Teacher::find($leave->user_id))->name
                : optional(Student::find($leave->user_id))->name;
            return $leave;
        });

        return view('admin.leaves.index', compact('leaves'));
    }

    public function show(Leave $leave)
    {
        $leave->user_name = $leave->user_type === 'teacher'
            ? optional(Teacher::find($leave->user_id))->name
            : optional(Student::find($leave->user_id))->name;

        return view('admin.leaves.show', compact('leave'));
    }

    public function update(Request $request, Leave $leave)
    {
        $request->validate([
            'status'        => 'required|in:approved,rejected',
            'admin_remarks' => 'nullable|string|max:500',
        ]);

        $leave->update([
            'status'        => $request->status,
            'admin_remarks' => $request->admin_remarks,
        ]);

        return redirect()->route('admin.leaves.index')
            ->with('success', 'Leave ' . $request->status . ' successfully.');
    }
}
