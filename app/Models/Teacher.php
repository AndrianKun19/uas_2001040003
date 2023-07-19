<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_code', 'name', 'place_of_birth', 'gender',
        'date_of_birth', 'address', 'contact_number', 'email',
        
    ];
    public function user()
    {
        return $this->hasOne(User::class, 'teacher_code', 'user_code');
    }
}
