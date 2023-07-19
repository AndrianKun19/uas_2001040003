<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $teacher
        ], 200);
    }
    public function show($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $teacher
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'teacher_code' => 'required|unique:teachers,teacher_code',
            'name' => 'required',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
        ]);
        $teacher = Teacher::create($request->all());
        if (!$teacher) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $teacher
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'teacher_code' => 'required|unique:teachers,teacher_code,'.$id.',id',
            'name' => 'required',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'address' => 'required',
        ]);
        if ($teacher->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $teacher
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $teacher = Teacher::find($id);
        if (!$teacher) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($teacher->delete()) {
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
