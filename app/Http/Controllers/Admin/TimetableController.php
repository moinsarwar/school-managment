<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Timetable;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function index(Request $request)
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();

        $classId   = $request->class_id;
        $sectionId = $request->section_id;
        $timetable = collect();

        if ($classId && $sectionId) {
            $timetable = Timetable::with(['subject', 'teacher'])
                ->where('class_id', $classId)
                ->where('section_id', $sectionId)
                ->orderBy('day')
                ->orderBy('period')
                ->get()
                ->groupBy('day');
        }

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        return view('admin.timetables.index', compact('classes', 'sections', 'timetable', 'classId', 'sectionId', 'days'));
    }

    public function create()
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $days     = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('admin.timetables.create', compact('classes', 'sections', 'subjects', 'teachers', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'day'        => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'period'     => 'required|integer|min:1|max:10',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i',
        ]);

        // Check for conflict
        $exists = Timetable::where('class_id', $request->class_id)
            ->where('section_id', $request->section_id)
            ->where('day', $request->day)
            ->where('period', $request->period)
            ->exists();

        if ($exists) {
            return back()->withErrors(['period' => 'A slot already exists for this class, section, day and period.'])->withInput();
        }

        Timetable::create($request->only('class_id', 'section_id', 'day', 'period', 'subject_id', 'teacher_id', 'start_time', 'end_time'));

        return redirect()->route('admin.timetables.index', [
            'class_id'   => $request->class_id,
            'section_id' => $request->section_id,
        ])->with('success', 'Timetable slot added successfully.');
    }

    public function edit(Timetable $timetable)
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $days     = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return view('admin.timetables.edit', compact('timetable', 'classes', 'sections', 'subjects', 'teachers', 'days'));
    }

    public function update(Request $request, Timetable $timetable)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'day'        => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'period'     => 'required|integer|min:1|max:10',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'nullable|exists:teachers,id',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i',
        ]);

        $timetable->update($request->only('class_id', 'section_id', 'day', 'period', 'subject_id', 'teacher_id', 'start_time', 'end_time'));

        return redirect()->route('admin.timetables.index', [
            'class_id'   => $request->class_id,
            'section_id' => $request->section_id,
        ])->with('success', 'Timetable slot updated.');
    }

    public function destroy(Timetable $timetable)
    {
        $classId   = $timetable->class_id;
        $sectionId = $timetable->section_id;
        $timetable->delete();
        return redirect()->route('admin.timetables.index', [
            'class_id'   => $classId,
            'section_id' => $sectionId,
        ])->with('success', 'Slot deleted.');
    }
}
