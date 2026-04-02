<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    protected $fillable = [
        'student_id', 'fee_structure_id', 'amount_paid',
        'status', 'month', 'year', 'paid_date', 'remarks'
    ];

    protected $casts = ['paid_date' => 'date'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }
}
