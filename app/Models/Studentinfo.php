<?php

namespace App\Models;

use App\Models\User;
use App\Models\Grade;
use App\Models\Degree;
use App\Models\Section;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Studentinfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade_id',
        'classroom_id',
        'section_id',
        'parent_id',
        'Nationality',

    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');

    }


    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');

    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id');

    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');

    }


    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');

    }

    public static function Validation(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'student_id' => 'required|exists:users,id',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'parent_id' => 'required|exists:users,id',
            'Nationality' => 'required|between:2,100',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'student_id');

    }

    public function degree()
    {
        return $this->hasMany(Degree::class, 'studentinfo_id');

    }

}
