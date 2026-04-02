<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = ['class_id', 'fee_type', 'amount', 'description'];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function payments()
    {
        return $this->hasMany(FeePayment::class);
    }
}
