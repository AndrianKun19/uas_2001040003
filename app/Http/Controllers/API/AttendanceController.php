<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendance = Attendance::with(
            'schedule', 'student')
            ->get();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $attendance
        ], 200);
    }
    public function show($id)
    {
        $attendance = Attendance::with(
            'schedule', 'student')
            ->where('id', $id)
            ->get();
        if (!$attendance) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $attendance
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'student_id' => 'required|exists:students,id',
            'date' => 'required',
            'status' => 'required|in:Hadir,Alpa,Izin,Sakit'
        ]);
        $attendance = Attendance::create($request->all());
        if (!$attendance) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $attendance
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'student_id' => 'required|exists:students,id',
            'date' => 'required',
            'status' => 'required|in:Hadir,Alpa,Izin,Sakit'
        ]);
        if ($attendance->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $attendance
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        if (!$attendance) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($attendance->delete()) {
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
