<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('landing-pages.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],[
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect()->route('student.index');
        } else {
            return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Username atau Password salah');
        }

    }
    public function changePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'username' => 'required|unique:users,username,'.$id.',id',
            'password' => 'required|min:8',
        ],[
            'password.required' => 'Password wajib diisi',
            'password.unique' => 'Masukkan minimal 8 karakter',
        ]);
        $user->update([
            'username' => $request->username,
            'password' => bcrypt($request->password),
        ]);

        if ($user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('success', 'Berhasil mengubah Password');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah Password');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('landing');
    }
}
