<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'classroom_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');

    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'subject_id');

    }


    public function exams()
    {
        return $this->hasMany(Exam::class, 'subject_id');

    }
}
