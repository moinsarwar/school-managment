<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeePayment;
use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class FeePaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = FeePayment::with(['student', 'feeStructure.schoolClass']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        $payments = $query->orderBy('id', 'desc')->paginate(20);

        return view('admin.fees.payments.index', compact('payments'));
    }

    public function create()
    {
        $students   = Student::with('schoolClass')->orderBy('name')->get();
        $structures = FeeStructure::with('schoolClass')->get();
        return view('admin.fees.payments.create', compact('students', 'structures'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id'        => 'required|exists:students,id',
            'fee_structure_id'  => 'required|exists:fee_structures,id',
            'amount_paid'       => 'required|numeric|min:0',
            'status'            => 'required|in:paid,partial,unpaid',
            'month'             => 'required|string',
            'year'              => 'required|digits:4',
            'paid_date'         => 'nullable|date',
            'remarks'           => 'nullable|string|max:500',
        ]);

        FeePayment::create($request->only(
            'student_id', 'fee_structure_id', 'amount_paid',
            'status', 'month', 'year', 'paid_date', 'remarks'
        ));

        return redirect()->route('admin.fee-payments.index')
            ->with('success', 'Fee payment recorded successfully.');
    }

    public function defaulters()
    {
        // Students with any unpaid/partial fee in current month
        $currentMonth = date('F');
        $currentYear  = date('Y');

        $unpaid = FeePayment::with(['student.schoolClass', 'feeStructure'])
            ->where('status', '!=', 'paid')
            ->where('month', $currentMonth)
            ->where('year', $currentYear)
            ->get();

        return view('admin.fees.defaulters', compact('unpaid', 'currentMonth', 'currentYear'));
    }
}
