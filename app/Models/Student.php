<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_code', 'name', 'place_of_birth', 'email', 'gender',
        'date_of_birth', 'address', 'contact_number', 'parent_name',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'student_code', 'user_code');
    }
}
