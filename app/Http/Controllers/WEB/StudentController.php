<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        return view('crud-views.students.index', compact('student'));
    }
    public function show($student_code)
    {   
        $student = User::with('student')->where('user_code', $student_code)->first();
        if (!$student) {
            $makeUser = Student::where('student_code', $student_code)->first();
            $changeFormat = date('dmY', strtotime($makeUser->date_of_birth));
            $password = str_replace('-', '', $changeFormat);
            User::create([
                'name' => $makeUser->name,
                'user_code' => $makeUser->student_code,
                'role' => 'Student',
                'username' => $makeUser->student_code,
                'password' => bcrypt($password), 
            ]);
        }
        return view('crud-views.students.show', compact('student'));
    }
    public function create()
    {
        return view('crud-views.students.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'student_code' => 'required|unique:students,student_code',
            'name' => 'required',
            'gender' => 'required|in:Laki - laki,Perempuan',
            'date_of_birth' => 'required'
        ],[
            'student_code.required' => 'NIS wajib diisi',
            'student_code.unique' => 'NIS sudah terdaftar',
            'name.required' => 'Nama Siswa wajib diisi',
            'gender.required' => 'Jenis Kelamin wajib diisi',
            'gender.in' => 'Masukkan antara Laki - laki dan Perempuan',
            'date_of_birth.required' => 'Tanggal lahir wajib diisi'
        ]);
                // dd($request->student_code);

        $exception = DB::transaction(function () use ($request) {
            $changeFormat = date('dmY', strtotime($request->date_of_birth));
            $password = str_replace('-', '', $changeFormat);

            Student::create($request->all());
            User::create([
                'name' => $request->name,
                'user_code' => $request->student_code,
                'role' => 'Student',
                'username' => $request->student_code,
                'password' => bcrypt($password), 
            ]);
        });
        if (is_null($exception)) {
            return redirect()
                ->route('student.index')
                ->with('success', 'Berhasil menambahkan data Siswa');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan data Siswa');
        }
    }
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('crud-views.students.edit', compact('student'));
    }
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $request->validate([
            // 'student_number' => 'required|unique:students,student_number,null,'.$student->id,
            'name' => 'required',
        ],[
            'student_code.required' => 'NIS wajib diisi',
            'student_code.unique' => 'NIS sudah terdaftar',
            'name.required' => 'Nama Siswa wajib diisi'
        ]);
        $student->update([
            // 'student_number' => $request->student_number,
            'name' => $request->name,
            'place_of_birth' => $request->place_of_birth,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'contact_number' => $request->contact_number,
            'email' => $request->email,
            'parent_name' => $request->parent_name,
        ]);

        if ($student) {
            return redirect()
                ->route('student.index')
                ->with('success', 'Berhasil mengubah data Siswa');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah data Siswa');
        }
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        
        if ($student->delete()) {
            return redirect()
                ->route('student.index')
                ->with('success', 'Berhasil menghapus dara Siswa');
        } else {
            return redirect()
                ->route('student.index')
                ->with('error', 'Gagal menghapus data Siswa');
        }
    }
    public function search(Request $request)
	{
		$search = $request->search;
        $student = Student::where('name', $request->search)->get();
        return view('crud-views.students.index', compact(['student', 'search']));
	}
}
