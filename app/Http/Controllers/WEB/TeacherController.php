<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return view('crud-views.teachers.index', compact('teacher'));
    }
    public function show($teacher_code)
    {
        $teacher = User::with('teacher')->where('user_code', $teacher_code)->first();
        if (!$teacher) {
            $makeUser = Teacher::where('teacher_code', $teacher_code)->first();
            $changeFormat = date('dmY', strtotime($makeUser->date_of_birth));
            $password = str_replace('-', '', $changeFormat);
            User::create([
                'name' => $makeUser->name,
                'user_code' => $makeUser->teacher_code,
                'role' => 'Teacher',
                'username' => $makeUser->teacher_code,
                'password' => bcrypt($password), 
            ]);
        }
        return view('crud-views.teachers.show', compact('teacher'));
    }
    public function create()
    {
        return view('crud-views.teachers.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'teacher_code' => 'required|unique:teachers,teacher_code',
            'name' => 'required',
        ],[
            'teacher_code.required' => 'NIP wajib diisi',
            'teacher_code.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama Guru wajib diisi'
        ]);
        // dd($request->teacher_code);
        $teacher = Teacher::create($request->all());
        if ($teacher) {
            return redirect()
                ->route('teacher.index')
                ->with('success', 'Berhasil menambahkan data Guru');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan data Guru');
        }
    }
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('crud-views.teachers.edit', compact('teacher'));
    }
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);
        $request->validate([
            // 'teacher_code' => 'required|unique:teachers,teacher_code,null,'.$teacher->id,
            'name' => 'required',
        ],[
            'teacher_code.required' => 'NIP wajib diisi',
            'teacher_code.unique' => 'NIP sudah terdaftar',
            'name.required' => 'Nama Guru wajib diisi'
        ]);
        $teacher->update([
            // 'teacher_code' => $request->teacher_code,
            'name' => $request->name,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'parent_name' => $request->parent_name,
            'email' => $request->email,
        ]);

        if ($teacher) {
            return redirect()
                ->route('teacher.index')
                ->with('success', 'Berhasil mengubah data Guru');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah data Guru');
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        if ($teacher) {
            return redirect()
                ->route('teacher.index')
                ->with('success', 'Berhasil menghapus dara Guru');
        } else {
            return redirect()
                ->route('teacher.index')
                ->with('error', 'Gagal menghapus data Guru');
        }
    }
}
