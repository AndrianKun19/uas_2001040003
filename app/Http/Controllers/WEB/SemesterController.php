<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index()
    {
        $semester = Semester::all();
        return view('crud-views.semesters.index', compact('semester'));
    }
    public function create()
    {
        $semester = Semester::all();
        return view('crud-views.semesters.index', compact('semester'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'semester_type' => 'required|in:Ganjil,Genap',
        ],[
            'semester_type.required' => 'Tipe Semester wajib diisi',
            'semester_type.in' => 'Pilih antara Ganjil dan Genap',
        ]);
        
        $semester = Semester::create([
            'semester_type' => $request->semester_type,
            'academic_year' => '20'.$request->academic_year_1.'/20'.$request->academic_year_2
        ]);
        if ($semester) {
            return redirect()
                ->route('semester.index')
                ->with('success', 'Berhasil menambahkan Semester');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan Semester');
        }
    }
    public function edit($id)
    {
        $semester = Semester::all();
        $semesterId = Semester::findOrFail($id);
        return view('crud-views.semesters.index', compact('semester', 'semesterId'));
    }
    public function update(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);
        $request->validate([
            'semester_type' => 'required|in:Ganjil,Genap',
            'academic_year' => 'required',
        ],[
            'semester_type.required' => 'Tipe Semester wajib diisi',
            'semester_type.in' => 'Pilih antara Ganjil dan Genap',
            'academic_year.required' => 'Tahun Akademik wajib diisi',
        ]);
        $semester->update($request->all());

        if ($semester) {
            return redirect()
                ->route('semester.index')
                ->with('success', 'Berhasil mengubah Semester');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah Semester');
        }
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();

        if ($semester) {
            return redirect()
                ->route('semester.index')
                ->with('success', 'Berhasil menghapus Semester');
        } else {
            return redirect()
                ->route('semester.index')
                ->with('error', 'Gagal menghapus Semester');
        }
    }
}
