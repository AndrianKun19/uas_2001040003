<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Semester;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $semester
        ], 200);
    }
    public function show($id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $semester
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester_type' => 'required|in:Ganjil,Genap',
            'academic_year' => 'required',
        ]);
        $semester = Semester::create($request->all());
        if (!$semester) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $semester
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'semester_type' => 'required|in:Ganjil,Genap',
            'academic_year' => 'required',
        ]);
        if ($semester->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $semester
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $semester = Semester::find($id);
        if (!$semester) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($semester->delete()) {
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
