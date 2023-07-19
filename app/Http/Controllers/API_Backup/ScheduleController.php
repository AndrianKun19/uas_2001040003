<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedule = Schedule::with(
            'classRoom', 'teacher', 'course', 'level', 'semester')
            ->get();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $schedule
        ], 200);
    }
    public function show($id)
    {
        $schedule = Schedule::with(
        'classRoom', 'teacher', 'course', 'level', 'semester')
        ->where('id', $id)
        ->get();
        if (!$schedule) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $schedule
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'schedule_code' => 'required|unique:schedules,schedule_code',
            'name' => 'required',
            'description' => 'required',
        ]);
        $schedule = Schedule::create($request->all());
        if (!$schedule) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $schedule
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'schedule_code' => 'required|unique:schedules,schedule_code,'.$id.',id',
            'name' => 'required',
            'description' => 'required',
        ]);
        if ($schedule->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $schedule
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($schedule->delete()) {
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
