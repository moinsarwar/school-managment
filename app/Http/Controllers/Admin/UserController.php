<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Office;
use App\Models\ParentGuardian;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $admins   = Admin::orderBy('name')->get();
        $teachers = Teacher::orderBy('name')->get();
        $students = Student::with(['schoolClass', 'section'])->orderBy('name')->get();
        $offices  = Office::orderBy('name')->get();
        $parents  = ParentGuardian::orderBy('name')->get();

        return view('admin.users.index', compact('admins', 'teachers', 'students', 'offices', 'parents'));
    }

    public function create()
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        return view('admin.users.create', compact('classes', 'sections', 'subjects'));
    }

    public function store(Request $request)
    {
        $role = $request->input('role');

        $base = $request->validate([
            'role'     => 'required|in:admin,teacher,student,office,parent',
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        switch ($role) {
            case 'admin':
                if (Admin::where('email', $request->email)->exists()) {
                    return back()->withErrors(['email' => 'Email already taken.'])->withInput();
                }
                Admin::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                break;

            case 'office':
                if (Office::where('email', $request->email)->exists()) {
                    return back()->withErrors(['email' => 'Email already taken.'])->withInput();
                }
                Office::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                break;

            case 'parent':
                if (ParentGuardian::where('email', $request->email)->exists()) {
                    return back()->withErrors(['email' => 'Email already taken.'])->withInput();
                }
                ParentGuardian::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                break;

            case 'teacher':
                $request->validate([
                    'phone'      => 'nullable|string|max:20',
                    'subject_id' => 'nullable|exists:subjects,id',
                    'class_id'   => 'nullable|exists:classes,id',
                ]);
                if (Teacher::where('email', $request->email)->exists()) {
                    return back()->withErrors(['email' => 'Email already taken.'])->withInput();
                }
                Teacher::create([
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'password'   => Hash::make($request->password),
                    'phone'      => $request->phone,
                    'subject_id' => $request->subject_id,
                    'class_id'   => $request->class_id,
                ]);
                break;

            case 'student':
                $request->validate([
                    'class_id'   => 'required|exists:classes,id',
                    'section_id' => 'required|exists:sections,id',
                    'roll_no'    => 'nullable|string|max:20',
                    'phone'      => 'nullable|string|max:20',
                ]);
                if (Student::where('email', $request->email)->exists()) {
                    return back()->withErrors(['email' => 'Email already taken.'])->withInput();
                }
                Student::create([
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'password'   => Hash::make($request->password),
                    'class_id'   => $request->class_id,
                    'section_id' => $request->section_id,
                    'roll_no'    => $request->roll_no,
                    'phone'      => $request->phone,
                ]);
                break;
        }

        return redirect()->route('admin.users.index')
            ->with('success', ucfirst($role) . ' created successfully.');
    }

    public function edit($role, $id)
    {
        $classes  = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();

        $user = match ($role) {
            'admin'   => Admin::findOrFail($id),
            'teacher' => Teacher::findOrFail($id),
            'student' => Student::findOrFail($id),
            'office'  => Office::findOrFail($id),
            'parent'  => ParentGuardian::findOrFail($id),
            default   => abort(404),
        };

        return view('admin.users.edit', compact('user', 'role', 'classes', 'sections', 'subjects'));
    }

    public function update(Request $request, $role, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = match ($role) {
            'admin'   => Admin::findOrFail($id),
            'teacher' => Teacher::findOrFail($id),
            'student' => Student::findOrFail($id),
            'office'  => Office::findOrFail($id),
            'parent'  => ParentGuardian::findOrFail($id),
            default   => abort(404),
        };

        $data = ['name' => $request->name, 'email' => $request->email];

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $data['password'] = Hash::make($request->password);
        }

        if ($role === 'teacher') {
            $data['phone']      = $request->phone;
            $data['subject_id'] = $request->subject_id;
            $data['class_id']   = $request->class_id;
        }

        if ($role === 'student') {
            $data['class_id']   = $request->class_id;
            $data['section_id'] = $request->section_id;
            $data['roll_no']    = $request->roll_no;
            $data['phone']      = $request->phone;
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', ucfirst($role) . ' updated successfully.');
    }

    public function destroy($role, $id)
    {
        $user = match ($role) {
            'admin'   => Admin::findOrFail($id),
            'teacher' => Teacher::findOrFail($id),
            'student' => Student::findOrFail($id),
            'office'  => Office::findOrFail($id),
            'parent'  => ParentGuardian::findOrFail($id),
            default   => abort(404),
        };

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', ucfirst($role) . ' deleted successfully.');
    }
}
