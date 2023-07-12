<?php

namespace App\Models;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'attachmentable_id',
        'attachmentable_type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_id');

    }

    public function attachmentable()
    {
        return $this->morphTo();
    }
}
