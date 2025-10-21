<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('Department.index', compact('departments'));
    }

    public function create()
    {
        return view('Department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments',
        ]);

        Department::create($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil ditambahkan.');
    }

    public function show(Department $department)
    {
        $department->load('employees');

        return view('Department.show', compact('department'));
    }

    public function edit(Department $department)
    {
        return view('Department.edit', compact('department'));
    }

    public function update(Request $request, Department $department)
    {
        $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
        ]);

        $department->update($request->all());

        return redirect()->route('departments.index')
            ->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department)
    {
        // Hati-hati: Jika ada pegawai di departemen ini, 
        // 'onDelete('cascade')' di migrasi akan menghapus pegawai tsb.
        try {
            $department->delete();
            return redirect()->route('departments.index')
                ->with('success', 'Departemen berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Menangkap error jika ada foreign key constraint
            return redirect()->route('departments.index')
                ->with('error', 'Departemen tidak bisa dihapus karena masih memiliki pegawai.');
        }
    }
}