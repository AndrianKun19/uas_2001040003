<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $student
        ], 200);
    }
    public function show($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $student
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_code' => 'required|unique:students,student_code',
            'name' => 'required',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
        ]);
        $student = Student::create($request->all());
        if (!$student) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $student
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'student_code' => 'required|unique:students,student_code,'.$id.',id',
            'name' => 'required',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
            'parent_name' => 'required',
        ]);
        if ($student->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $student
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($student->delete()) {
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
