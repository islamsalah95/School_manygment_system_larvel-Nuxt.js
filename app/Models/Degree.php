<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Studentinfo;

class Degree extends Model
{
    use HasFactory;


    protected $fillable = [
        'answer',
        'score',
        'studentinfo_id',
        'question_id',
        'exam_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function studentinfo()
    {
        return $this->belongsTo(Studentinfo::class, 'studentinfo_id');

    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');

    }


}
