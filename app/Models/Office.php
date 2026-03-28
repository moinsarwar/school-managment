<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Office extends Authenticatable
{
    protected $table = 'offices';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
