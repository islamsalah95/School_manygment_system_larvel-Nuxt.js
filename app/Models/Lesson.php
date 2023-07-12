<?php

namespace App\Models;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'subject_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');

    }



    public function attachment()
    {
        return $this->morphMany(Attachment::class, 'attachmentable');
    }

}
