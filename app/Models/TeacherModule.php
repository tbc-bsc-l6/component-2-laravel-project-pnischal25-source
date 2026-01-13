<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TeacherModule extends Pivot
{
    protected $table = 'teacher_modules';
    
    protected $fillable = [
        'user_id',
        'module_id',
    ];
}
