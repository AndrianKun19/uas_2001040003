<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $course = Course::all();
        return view('crud-views.courses.index', compact('course'));
    }
    public function create()
    {
        return view('crud-views.courses.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'course_code' => 'required|unique:courses,course_code',
            'name' => 'required',
            'description' => 'required'
        ],[
            'course_number.required' => 'Kode Mapel wajib diisi',
            'course_number.unique' => 'Kode Mapel sudah terdaftar',
            'name.required' => 'Mata Pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi'
        ]);
        $course = Course::create($request->all());
        if ($course) {
            return redirect()
                ->route('course.index')
                ->with('success', 'Berhasil menambahkan Mata Pelajaran');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan Mata Pelajaran');
        }
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('crud-views.courses.edit', compact('course'));
    }
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $request->validate([
            // 'course_code' => 'required|unique:courses,course_number,null,'.$course->id,
            'name' => 'required',
            'description' => 'required'
        ],[
            // 'course_number.required' => 'NIP wajib diisi',
            // 'course_number.unique' => 'Kode Mapel sudah terdaftar',
            'name.required' => 'Mata Pelajaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi'
        ]);
        $course->update([
            // 'course_code' => $request->course_number,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($course) {
            return redirect()
                ->route('course.index')
                ->with('success', 'Berhasil mengubah Mata Pelajaran');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah Mata Pelajaran');
        }
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        if ($course) {
            return redirect()
                ->route('course.index')
                ->with('success', 'Berhasil menghapus Mata Pelajaran');
        } else {
            return redirect()
                ->route('course.index')
                ->with('error', 'Gagal menghapus Mata Pelajaran');
        }
    }
}
