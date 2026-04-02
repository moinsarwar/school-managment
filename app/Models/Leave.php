<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'user_type', 'user_id', 'from_date', 'to_date',
        'reason', 'status', 'admin_remarks'
    ];

    protected $casts = ['from_date' => 'date', 'to_date' => 'date'];

    public function user()
    {
        if ($this->user_type === 'teacher') {
            return $this->belongsTo(Teacher::class, 'user_id');
        }
        return $this->belongsTo(Student::class, 'user_id');
    }
}
