<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRoom = ClassRoom::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $classRoom
        ], 200);
    }
    public function show($id)
    {
        $classRoom = ClassRoom::find($id);
        if (!$classRoom) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $classRoom
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_code' => 'required|unique:class_rooms,class_code',
            'name' => 'required',
            'capacity' => 'required|numeric',
        ]);
        $classRoom = ClassRoom::create($request->all());
        if (!$classRoom) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $classRoom
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $classRoom = ClassRoom::find($id);
        if (!$classRoom) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'class_code' => 'required|unique:class_rooms,class_code,'.$id.',id',
            'name' => 'required',
            'capacity' => 'required|numeric',
        ]);
        if ($classRoom->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $classRoom
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $classRoom = ClassRoom::find($id);
        if (!$classRoom) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($classRoom->delete()) {
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
