<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        $teacher = Auth::guard('teacher')->user();
        $grades = Grade::with(['student', 'subject', 'exam'])
            ->whereHas('student', function ($q) use ($teacher) {
                $q->where('class_id', $teacher->class_id);
            })
            ->latest()
            ->paginate(50);
        return view('teacher.grades.index', compact('grades'));
    }

    public function create()
    {
        $teacher = Auth::guard('teacher')->user();
        if (!$teacher->class_id) {
            return redirect()->route('teacher.grades.index')->with('error', 'No class assigned to you. Contact admin.');
        }
        $students = Student::where('class_id', $teacher->class_id)->orderBy('roll_number')->get();
        $subjects = Subject::where('class_id', $teacher->class_id)->get();
        $exams = Exam::where('class_id', $teacher->class_id)->get();
        return view('teacher.grades.create', compact('students', 'subjects', 'exams'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
            'grades' => 'required|array',
            'grades.*.marks' => 'required|numeric|min:0|max:100',
        ]);

        foreach ($request->grades as $studentId => $gradeData) {
            $marks = $gradeData['marks'];
            $grade = $this->calculateGrade($marks);

            Grade::updateOrCreate(
                ['student_id' => $studentId, 'subject_id' => $request->subject_id, 'exam_id' => $request->exam_id],
                ['marks' => $marks, 'grade' => $grade]
            );
        }

        return redirect()->route('teacher.grades.index')->with('success', 'Grades saved successfully.');
    }

    private function calculateGrade($marks)
    {
        if ($marks >= 90)
            return 'A+';
        if ($marks >= 80)
            return 'A';
        if ($marks >= 70)
            return 'B';
        if ($marks >= 60)
            return 'C';
        if ($marks >= 50)
            return 'D';
        return 'F';
    }
}
