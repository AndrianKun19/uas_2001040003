<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;

class ClassRoomController extends Controller
{
    public function index()
    {
        $classRoom = ClassRoom::all();
        return view('crud-views.class-rooms.index', compact('classRoom'));
    }
    public function create()
    {
        return view('crud-views.class-rooms.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'class_code' => 'required|unique:class_rooms,class_code',
            'name' => 'required',
            'capacity' => 'required|numeric'
        ],[
            'class_code.required' => 'Kode kelas wajib diisi',
            'class_code.unique' => 'Kode kelas sudah terdaftar',
            'name.required' => 'Nama Kelas wajib diisi',
            'capacity.required' => 'Kapasitas wajib diisi',
            'capacity.numeric' => 'hanya boleh memasukkan angka'
        ]);
        $classRoom = ClassRoom::create($request->all());
        if ($classRoom) {
            return redirect()
                ->route('class-room.index')
                ->with('success', 'Berhasil menambahkan ruang kelas');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'gagal Menambahkan ruang kelas');
        }
    }
    public function edit($id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        return view('crud-views.class-rooms.edit', compact('classRoom'));
    }
    public function update(Request $request, $id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $request->validate([
            // 'class_code' => 'required|unique:class_rooms,class_code,'.$id.'id',
            'name' => 'required',
            'capacity' => 'required|numeric'
        ],[
            // 'class_code.required' => 'Kode kelas wajib diisi',
            // 'class_code.unique' => 'Kode kelas sudah terdaftar',
            'name.required' => 'Nama Kelas wajib diisi',
            'capacity.required' => 'Kapasitas wajib diisi',
            'capacity.numeric' => 'hanya boleh memasukkan angka'
        ]);
        $classRoom->update($request->all());

        if ($classRoom) {
            return redirect()
                ->route('class-room.index')
                ->with('success', 'Berhasil mengubah ruang kelas');
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal mengubah ruang kelas');
        }
    }
    public function destroy($id)
    {
        $classRoom = ClassRoom::findOrFail($id);
        $classRoom->delete();

        if ($classRoom) {
            return redirect()
                ->route('class-room.index')
                ->with('success', 'Berhasil menghapus ruang kelas');
        } else {
            return redirect()
                ->route('class-room.index')
                ->with('error', 'Gagal menghapus ruang kelas');
        }
    }
    public function search(Request $request)
	{
		$search = $request->search;
        $classRoom = ClassRoom::where('name', $request->search)->get();
        return view('crud-views.class-rooms.index', compact(['classRoom', 'search']));
	}
}
