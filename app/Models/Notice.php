<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = ['title', 'body', 'target', 'published_at'];

    protected $casts = ['published_at' => 'date'];
}
