<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('Position.index', compact('positions'));
    }

    public function create()
    {
        return view('Position.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Position::create($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function show(Position $position)
    {
        // Tampilkan detail jabatan & siapa saja pegawainya
        $position->load('employees');
        return view('Position.show', compact('position'));
    }

    public function edit(Position $position)
    {
        return view('Position.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $position->update($request->all());

        return redirect()->route('positions.index')
            ->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function destroy(Position $position)
    {
        try {
            $position->delete();
            return redirect()->route('positions.index')
                ->with('success', 'Jabatan berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('positions.index')
                ->with('error', 'Jabatan tidak bisa dihapus karena masih digunakan oleh pegawai.');
        }
    }
}