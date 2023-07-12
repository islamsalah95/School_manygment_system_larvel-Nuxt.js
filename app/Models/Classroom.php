<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Studentinfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'grade_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');

    }


    public function section()
    {
        return $this->hasMany(Section::class, 'classroom_id');

    }

    public function student()
    {
        return $this->hasMany(Studentinfo::class, 'classroom_id');

    }

    public function subject()
    {
        return $this->hasMany(Subject::class, 'classroom_id');

    }

}
