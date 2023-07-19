<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    public function index()
    {
        $level = Level::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $level
        ], 200);
    }
    public function show($id)
    {
        $level = Level::find($id);
        if (!$level) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $level
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|numeric',
        ]);
        $level = Level::create($request->all());
        if (!$level) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $level
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $level = Level::find($id);
        if (!$level) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'level' => 'required|numeric',
        ]);
        if ($level->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $level
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $level = Level::find($id);
        if (!$level) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($level->delete()) {
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
