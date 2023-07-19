<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Enrollment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollment = Enrollment::with(
            'classRoom', 'teacher', 'student', 'level', 'semester')
            ->get();
        // dd($enrollment);
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $enrollment
        ], 200);
    }
    public function show($id)
    {
        $enrollment = Enrollment::with('classRoom', 'teacher', 'student', 'level', 'semester')
            ->where('id', $id)
            ->get();
        if (!$enrollment) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        
        // dd($enrollment);
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $enrollment
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'level_id' => 'required|exists:levels,id',
            'semester_id' => 'required|exists:semesters,id',
        ]);    
        $enrollment = Enrollment::create($request->all());
        if (!$enrollment) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $enrollment
        ], 201);
        return response()->json([
            'message' => 'Failed to create data.',
            'data' => []
        ], 400);
        
        dd($enrollPerSem);
        $enrollment = Enrollment::create($request->all());
        if (!$enrollment) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $enrollment
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'class_id' => 'required|exists:class_rooms,id',
            'teacher_id' => 'required|exists:teachers,id',
            'student_id' => 'required|exists:students,id',
            'level_id' => 'required|exists:levels,id',
            'semester_id' => 'required|exists:semesters,id',
        ]); 
        if ($enrollment->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $enrollment
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $enrollment = Enrollment::find($id);
        if (!$enrollment) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($enrollment->delete()) {
            return response()->json([
                'message' => 'Data deleted successfully.',
                'data' => []
            ], 200);
        }
        return response()->json([
            'message' => 'Failed to delete data.',
            'data' => []
        ], 400);
    }
}
