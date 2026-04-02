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
use App\Http\Controllers\ParentAuthController;
use App\Http\Controllers\ParentDashboardController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\FeePaymentController;
use App\Http\Controllers\Admin\TimetableController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Teacher\AttendanceController as TeacherAttendanceController;
use App\Http\Controllers\Teacher\GradeController;
use App\Http\Controllers\Teacher\LeaveController as TeacherLeaveController;
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

        // Classes / Sections / Subjects / Teachers / Students / Exams
        Route::resource('classes', ClassController::class)->names('admin.classes')->parameters(['classes' => 'class']);
        Route::resource('sections', SectionController::class)->names('admin.sections');
        Route::resource('subjects', SubjectController::class)->names('admin.subjects');
        Route::resource('teachers', TeacherController::class)->names('admin.teachers');
        Route::resource('students', StudentController::class)->names('admin.students');
        Route::resource('exams', ExamController::class)->names('admin.exams');

        // Attendance (read-only)
        Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance.index');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{role}/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{role}/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{role}/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

        // Fee Management
        Route::resource('fee-structures', FeeStructureController::class)->names('admin.fee-structures');
        Route::resource('fee-payments', FeePaymentController::class)->names('admin.fee-payments')->except(['edit', 'update', 'show']);
        Route::get('/fee-defaulters', [FeePaymentController::class, 'defaulters'])->name('admin.fee-payments.defaulters');

        // Timetable
        Route::resource('timetables', TimetableController::class)->names('admin.timetables');

        // Promotions
        Route::get('/promotions', [PromotionController::class, 'index'])->name('admin.promotions.index');
        Route::get('/promotions/create', [PromotionController::class, 'create'])->name('admin.promotions.create');
        Route::post('/promotions', [PromotionController::class, 'store'])->name('admin.promotions.store');

        // Leaves
        Route::get('/leaves', [AdminLeaveController::class, 'index'])->name('admin.leaves.index');
        Route::get('/leaves/{leave}', [AdminLeaveController::class, 'show'])->name('admin.leaves.show');
        Route::put('/leaves/{leave}', [AdminLeaveController::class, 'update'])->name('admin.leaves.update');

        // Notices
        Route::resource('notices', NoticeController::class)->names('admin.notices');

        // Events
        Route::resource('events', EventController::class)->names('admin.events');
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

        // Leave
        Route::get('/leaves', [TeacherLeaveController::class, 'index'])->name('teacher.leaves.index');
        Route::get('/leaves/apply', [TeacherLeaveController::class, 'create'])->name('teacher.leaves.create');
        Route::post('/leaves', [TeacherLeaveController::class, 'store'])->name('teacher.leaves.store');
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

/*
|--------------------------------------------------------------------------
| Parent Routes
|--------------------------------------------------------------------------
*/
Route::prefix('parent')->group(function () {
    Route::get('/login', [ParentAuthController::class, 'showLoginForm'])->name('parent.login');
    Route::post('/login', [ParentAuthController::class, 'login'])->name('parent.login.submit');
    Route::post('/logout', [ParentAuthController::class, 'logout'])->name('parent.logout');

    Route::middleware('parent')->group(function () {
        Route::get('/dashboard', [ParentDashboardController::class, 'index'])->name('parent.dashboard');
        Route::get('/child/{student}/attendance', [ParentDashboardController::class, 'childAttendance'])->name('parent.child.attendance');
        Route::get('/child/{student}/results', [ParentDashboardController::class, 'childResults'])->name('parent.child.results');
        Route::get('/child/{student}/fees', [ParentDashboardController::class, 'childFees'])->name('parent.child.fees');
    });
});

