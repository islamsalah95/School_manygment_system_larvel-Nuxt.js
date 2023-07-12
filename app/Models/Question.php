<?php

namespace App\Models;

use App\Models\Exam;
use App\Models\Degree;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'A',
        'B',
        'C',
        'D',
        'correct',
        'score',
        'exam_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');

    }

    public function degree()
    {
        return $this->hasMany(Degree::class, 'question_id');

    }
}
