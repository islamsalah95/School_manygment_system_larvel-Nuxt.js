<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finesh_exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'exam_id',
        'studentinfo_id',
        'start_exam',
        'end_exam',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
