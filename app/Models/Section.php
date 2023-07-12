<?php

namespace App\Models;

use App\Models\Classroom;
use App\Models\Studentinfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
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


    public function student()
    {
        return $this->belongsTo(Studentinfo::class, 'section_id');

    }

}
