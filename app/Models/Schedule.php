<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $fillable = [
        'level_id', 'semester_id', 'course_id', 'teacher_id',
        'class_id', 'day', 'start_time', 'end_time'
    ];
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function semester()
    {
        return $this->belongsTo(Level::class, 'semester_id');
    }
    public function course()
    {
        return $this->belongsTo(Level::class, 'course_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Level::class, 'teacher_id');
    }
    public function classRoom()
    {
        return $this->belongsTo(Level::class, 'class_id');
    }
}
