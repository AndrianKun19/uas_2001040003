<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index()
    {
        $grade = Grade::with(
            'schedule', 'student')
            ->get();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $grade
        ], 200);
    }
    public function show($id)
    {
        $grade = Grade::with(
            'schedule', 'student')
            ->where('id', $id)
            ->get();
        if (!$grade) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $grade
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'grade_code' => 'required|unique:grades,grade_code',
            'name' => 'required',
            'description' => 'required',
        ]);
        $grade = Grade::create($request->all());
        if (!$grade) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $grade
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'grade_code' => 'required|unique:grades,grade_code,'.$id.',id',
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($grade->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $grade
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $grade = Grade::find($id);
        if (!$grade) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($grade->delete()) {
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
