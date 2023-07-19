<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'schedule_id', 'student_id', 'date', 'status',
    ];  
    public function schedule()
    {
        return $this->belongsTo(Teacher::class, 'shcedule_id');
    }
    public function student()
    {
        return $this->belongsTo(Teacher::class, 'student_id');
    }
}
