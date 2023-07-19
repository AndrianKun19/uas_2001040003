<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    public function index($id)
    {
        if ($id != '-') {
            $enrollment = Enrollment::with('teacher', 'classRoom', 'level', 'semester')
            ->select('teacher_id', 'class_id', 'level_id', 'semester_id',
            DB::raw('COUNT(student_id) as total_students'))
            ->where('semester_id', $id)
            ->groupBy('teacher_id', 'class_id', 'level_id', 'semester_id')
            ->get();
        }else {
            $enrollment = Enrollment::with('teacher', 'classRoom', 'level', 'semester')
            ->select('teacher_id', 'class_id', 'level_id', 'semester_id', 
            DB::raw('COUNT(student_id) as total_students'))
            ->groupBy('teacher_id', 'class_id', 'level_id', 'semester_id')
            ->get();
        }
        
        $semester = Semester::all();
        return view('crud-views.enrollments.index', compact('enrollment', 'semester'));
    }
    public function create()
    {
        return view('crud-views.enrollments.create');
    }
}
