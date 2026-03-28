<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TeacherAuthController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\OfficeAuthController;
use App\Http\Controllers\OfficeDashboardController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Office\AdmissionController;

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Classes
        Route::resource('classes', ClassController::class)->names('admin.classes')->parameters(['classes' => 'class']);
        // Sections
        Route::resource('sections', SectionController::class)->names('admin.sections');
        // Subjects
        Route::resource('subjects', SubjectController::class)->names('admin.subjects');
        // Teachers
        Route::resource('teachers', TeacherController::class)->names('admin.teachers');
        // Students
        Route::resource('students', StudentController::class)->names('admin.students');
        // Exams
        Route::resource('exams', ExamController::class)->names('admin.exams');
        // Attendance (read-only)
        Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance.index');
    });
});

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
*/
Route::prefix('teacher')->group(function () {
    Route::get('/login', [TeacherAuthController::class, 'showLoginForm'])->name('teacher.login');
    Route::post('/login', [TeacherAuthController::class, 'login'])->name('teacher.login.submit');
    Route::post('/logout', [TeacherAuthController::class, 'logout'])->name('teacher.logout');

    Route::middleware('teacher')->group(function () {
        Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');

        // Attendance
        Route::get('/attendance', [TeacherAttendanceController::class, 'index'])->name('teacher.attendance.index');
        Route::get('/attendance/mark', [TeacherAttendanceController::class, 'create'])->name('teacher.attendance.create');
        Route::post('/attendance/mark', [TeacherAttendanceController::class, 'store'])->name('teacher.attendance.store');

        // Grades
        Route::get('/grades', [GradeController::class, 'index'])->name('teacher.grades.index');
        Route::get('/grades/enter', [GradeController::class, 'create'])->name('teacher.grades.create');
        Route::post('/grades/enter', [GradeController::class, 'store'])->name('teacher.grades.store');
    });
});

/*
|--------------------------------------------------------------------------
| Student Routes
|--------------------------------------------------------------------------
*/
Route::prefix('student')->group(function () {
    Route::get('/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
    Route::post('/login', [StudentAuthController::class, 'login'])->name('student.login.submit');
    Route::post('/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

    Route::middleware('student')->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
        Route::get('/attendance', [StudentDashboardController::class, 'attendance'])->name('student.attendance');
        Route::get('/results', [StudentDashboardController::class, 'results'])->name('student.results');
    });
});

/*
|--------------------------------------------------------------------------
| Office Routes
|--------------------------------------------------------------------------
*/
Route::prefix('office')->group(function () {
    Route::get('/login', [OfficeAuthController::class, 'showLoginForm'])->name('office.login');
    Route::post('/login', [OfficeAuthController::class, 'login'])->name('office.login.submit');
    Route::post('/logout', [OfficeAuthController::class, 'logout'])->name('office.logout');

    Route::middleware('office')->group(function () {
        Route::get('/dashboard', [OfficeDashboardController::class, 'index'])->name('office.dashboard');
        Route::resource('admissions', AdmissionController::class)->names('office.admissions')->except('show', 'destroy');
    });
});
