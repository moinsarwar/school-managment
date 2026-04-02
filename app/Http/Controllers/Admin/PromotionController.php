<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $classes    = SchoolClass::orderBy('name')->get();
        $promotions = Promotion::with(['student', 'fromClass', 'toClass'])
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('admin.promotions.index', compact('promotions', 'classes'));
    }

    public function create(Request $request)
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $students = collect();
        $fromClass = null;

        if ($request->filled('class_id')) {
            $fromClass = SchoolClass::find($request->class_id);
            $students  = Student::where('class_id', $request->class_id)
                ->orderBy('name')
                ->get();
        }

        return view('admin.promotions.create', compact('classes', 'students', 'fromClass'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_ids'    => 'required|array|min:1',
            'student_ids.*'  => 'exists:students,id',
            'from_class_id'  => 'required|exists:classes,id',
            'to_class_id'    => 'nullable|exists:classes,id',
            'academic_year'  => 'required|string|max:10',
            'status'         => 'required|in:promoted,retained,graduated',
        ]);

        $fromClass = SchoolClass::find($request->from_class_id);
        $toClass   = $request->to_class_id ? SchoolClass::find($request->to_class_id) : null;

        foreach ($request->student_ids as $studentId) {
            Promotion::create([
                'student_id'    => $studentId,
                'from_class_id' => $request->from_class_id,
                'to_class_id'   => $request->to_class_id,
                'academic_year' => $request->academic_year,
                'status'        => $request->status,
                'remarks'       => $request->remarks,
            ]);

            // Update student's class if promoted
            if ($request->status === 'promoted' && $toClass) {
                Student::where('id', $studentId)->update(['class_id' => $toClass->id]);
            }
        }

        return redirect()->route('admin.promotions.index')
            ->with('success', count($request->student_ids) . ' student(s) processed successfully.');
    }
}
