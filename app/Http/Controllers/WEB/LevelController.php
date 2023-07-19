<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function index()
    {
        $level = Level::all();
        return view('crud-views.levels.index', compact('level'));
    }
    public function create()
    {
        $level = Level::all();
        return view('crud-views.levels.index', compact('level'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'level' => 'required|numeric',
        ],[
            'level.required' => 'Level wajib diisi',
            'level.numeric' => 'Level harus berupa angka',
        ]);
        $level = Level::create($request->all());
        if ($level) {
            return redirect()
                ->route('level.index')
                ->with('success', 'Berhasil menambahkan Level');
        } else {
            return redirect()
                ->route('level.index')
                ->with('error', 'gagal Menambahkan Level');
        }
    }
    public function edit($id)
    {
        $level = Level::all();
        $levelId = Level::findOrFail($id);
        return view('crud-views.levels.index', compact('level', 'levelId'));
    }
    public function update(Request $request, $id)
    {
        $level = Level::findOrFail($id);
        $request->validate([
            'level' => 'required|numeric',
        ],[
            'level.required' => 'Level wajib diisi',
            'level.numeric' => 'Level harus berupa angka',
        ]);
        $level->update($request->all());

        if ($level) {
            return redirect()
                ->route('level.index')
                ->with('success', 'Berhasil mengubah Level');
        } else {
            return redirect()
                ->route('level.index')
                ->with('error', 'Gagal mengubah Level');
        }
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();

        if ($level) {
            return redirect()
                ->route('level.index')
                ->with('success', 'Berhasil menghapus Level');
        } else {
            return redirect()
                ->route('level.index')
                ->with('error', 'Gagal menghapus Level');
        }
    }
}
