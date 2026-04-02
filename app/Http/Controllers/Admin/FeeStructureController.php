<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeeStructure;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function index()
    {
        $structures = FeeStructure::with('schoolClass')->orderBy('id', 'desc')->paginate(20);
        return view('admin.fees.structures.index', compact('structures'));
    }

    public function create()
    {
        $classes = SchoolClass::orderBy('name')->get();
        return view('admin.fees.structures.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'    => 'required|exists:classes,id',
            'fee_type'    => 'required|in:monthly,admission,exam,other',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        FeeStructure::create($request->only('class_id', 'fee_type', 'amount', 'description'));

        return redirect()->route('admin.fee-structures.index')
            ->with('success', 'Fee structure created successfully.');
    }

    public function edit(FeeStructure $feeStructure)
    {
        $classes = SchoolClass::orderBy('name')->get();
        return view('admin.fees.structures.edit', compact('feeStructure', 'classes'));
    }

    public function update(Request $request, FeeStructure $feeStructure)
    {
        $request->validate([
            'class_id'    => 'required|exists:classes,id',
            'fee_type'    => 'required|in:monthly,admission,exam,other',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $feeStructure->update($request->only('class_id', 'fee_type', 'amount', 'description'));

        return redirect()->route('admin.fee-structures.index')
            ->with('success', 'Fee structure updated successfully.');
    }

    public function destroy(FeeStructure $feeStructure)
    {
        $feeStructure->delete();
        return redirect()->route('admin.fee-structures.index')
            ->with('success', 'Fee structure deleted.');
    }
}
