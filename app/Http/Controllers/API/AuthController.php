<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;    
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request['username'], 'password' => $request['password']])) {
            $auth = Auth::user();
            $user = [];
            if ($auth->role === "Student") {
                $user = User::with('student')->where('user_code', $auth->user_code)->get();
            } else if ($auth->role === "Teacher") {
                $user = User::with('teacher')->where('id', $auth->user_code)->get();
            }
            $success['token'] = $auth->createToken('auth_token')->plainTextToken;
            $success['name'] = $auth->name;
            $success['data'] = $user;
            return response()->json([
                'message' => 'Login successful',
                'data' => $success
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid Username or Password',
                'data' => []
            ], 400);
        }
    }
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);
        $user->update([
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            return response()->json([
                'message' => 'Change Password successful',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Change Password Failed',
            ], 400);
        }
    }
    public function logout(Request $request)
    {
        $user = $request->user();

        if ($user->currentAccessToken()->delete()) {
            return response()->json([
                'message' => 'Logout successful',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Logout Failed',
            ], 400);
        }
    }
}
