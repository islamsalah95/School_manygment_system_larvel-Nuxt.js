<?php

namespace App\Models;

use App\Models\Studentinfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function classroom()
    {
        return $this->hasMany(Classroom::class, 'grade_id');

    }

    public function student()
    {
        return $this->hasMany(Studentinfo::class, 'grade_id');

    }
}
