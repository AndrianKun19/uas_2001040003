<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $user
        ], 200);
    }
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($user->role === "Student") {
            $user = User::with('student')->where('id', $id)->get();
        } else if ($user->role === "Teacher") {
            $user = User::with('teacher')->where('id', $id)->get();
        }
        return response()->json([
            'message' => 'Data retrieved successfully.',
            'data' => $user
        ], 200);
    }
    public function store(Request $request)
    {
        $request->validate([ 'role' => 'required|in:Administrator,Teacher,Student' ]);
        switch ($request->role) {
            case 'Teacher':
                $request->validate([
                    'name' => 'required',
                    'user_code' => 'required|unique:users,user_code|exists:teachers,teacher_code',
                    'username' => 'required|unique:users,username',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|min:8|same:password',
                ]);
                break;
            case 'Student':
                $request->validate([
                    'name' => 'required',
                    'user_code' => 'required|unique:users,user_code|exists:students,student_code',
                    'username' => 'required|unique:users,username',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|min:8|same:password',
                ]);
                break;
            case 'Administrator':
                $request->validate([
                    'name' => 'required',
                    'user_code' => 'required|unique:users,user_code',
                    'username' => 'required|unique:users,username',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required|min:8|same:password',
                ]);
                break;
            default:
                return response()->json([
                    'message' => 'Failed to create data.',
                    'data' => []
                ], 400);
                break;
        }
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());
        if (!$user) {
            return response()->json([
                'message' => 'Failed to create data.',
                'data' => []
            ], 400);
        } 
        return response()->json([
            'message' => 'Data created successfully.',
            'data' => $user
        ], 201);
    }
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        $request->validate([
            'name' => 'required',
            'user_code' => 'required|unique:users,user_code,'.$id.',id',
            'role' => 'required|in:Administrator,Teacher,Student',
            'username' => 'required|unique:users,username,'.$id.',id',
        ]);
        if ($user->update($request->all())) {
            return response()->json([
                'message' => 'Data updated successfully.',
                'data' => $user
            ], 200);
        } 
        return response()->json([
            'message' => 'Failed to update data.',
            'data' => []
        ], 400);
    }
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'Data not found.',
                'data' => []
            ], 404);
        }
        if ($user->delete()) {
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
