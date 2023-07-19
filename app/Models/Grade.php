<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = [
        'shcedule_id', 'student_id', 'grade', 'harian', 'UTS', 'UAS', 'NA'
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
