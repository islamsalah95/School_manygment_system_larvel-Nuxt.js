<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');

    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'exam_id');

    }


}
