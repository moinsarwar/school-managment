<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $table = 'teachers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'qualification',
        'class_id',
        'subject_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'marked_by');
    }
}
