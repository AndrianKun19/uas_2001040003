<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('crud-views.users.index', compact('user'));
    }
    public function create()
    {
        return view('crud-views.users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user_code' => 'required|unique:users,user_code',
            'role' => 'required|in:Administrator,Teacher,Student',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'Nama wajib diisi',
            'user_code.required' => 'Kode pengguna wajib diisi',
            'user_code.unique' => 'Kode pengguna sudah terdaftar',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Pilihan tidak tersedia',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Masukkan minimal 8 karakter',
        ]);

        $request['password'] = bcrypt($request->password);
        $user = User::create($request->all());  
        if ($user) {
            return redirect()
                ->route('user.index')
                ->with('success', 'Berhasil menambahkan data pengguna');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan data pengguna');
        }
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('crud-views.users.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {            
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required',
            // 'user_code' => 'required|unique:users,user_code,'.$id.',id',
            'role' => 'required|in:Administrator,Teacher,Student',
            'username' => 'required|unique:users,username,'.$id.',id',
            'password' => 'required|min:8'
        ],[
            'name.required' => 'Nama wajib diisi',
            // 'user_code.required' => 'Kode pengguna wajib diisi',
            // 'user_code.unique' => 'Kode pengguna sudah terdaftar',
            'role.required' => 'Role wajib diisi',
            'role.in' => 'Pilihan tidak tersedia',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Masukkan minimal 8 karakter',
        ]);
        $user->update($request->all());

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with('success', 'Berhasil mengubah data pengguna');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah data pengguna');
        }
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        if ($user) {
            return redirect()
                ->route('user.index')
                ->with('success', 'Berhasil menghapus dara pengguna');
        } else {
            return redirect()
                ->route('user.index')
                ->with('error', 'Gagal menghapus data pengguna');
        }
    }
    public function search(Request $request)
	{
		$search = $request->search;
        $user = User::where('name', $request->search)->get();
        return view('crud-views.users.index', compact(['user', 'search']));
	}
    
}
