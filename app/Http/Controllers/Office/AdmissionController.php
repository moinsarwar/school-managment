<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdmissionController extends Controller
{
    public function index()
    {
        $students = Student::with(['schoolClass', 'section'])->latest('admission_date')->get();
        return view('office.admissions.index', compact('students'));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        $sections = Section::all();
        return view('office.admissions.create', compact('classes', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'roll_number' => 'nullable|string|max:50',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'father_name', 'date_of_birth', 'gender', 'class_id', 'section_id', 'roll_number');
        $data['password'] = Hash::make($request->password);
        $data['admission_date'] = now()->toDateString();

        Student::create($data);
        return redirect()->route('office.admissions.index')->with('success', 'Student admitted successfully.');
    }

    public function edit(Student $admission)
    {
        $classes = SchoolClass::all();
        $sections = Section::all();
        return view('office.admissions.edit', compact('admission', 'classes', 'sections'));
    }

    public function update(Request $request, Student $admission)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $admission->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'father_name' => 'nullable|string|max:255',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',
            'roll_number' => 'nullable|string|max:50',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address', 'father_name', 'date_of_birth', 'gender', 'class_id', 'section_id', 'roll_number');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admission->update($data);
        return redirect()->route('office.admissions.index')->with('success', 'Student record updated successfully.');
    }
}
