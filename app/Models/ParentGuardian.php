<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ParentGuardian extends Authenticatable
{
    use Notifiable;

    protected $table = 'parents';

    protected $fillable = ['name', 'email', 'password', 'phone', 'cnic', 'address'];

    protected $hidden = ['password', 'remember_token'];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'parent_student');
    }
}
