<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // 'with' (Eager Loading) sangat penting untuk performa
        // Kita langsung ambil data relasinya (department dan position)
        $employees = Employee::with(['department', 'position'])->latest()->paginate(10);
        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        // Kita butuh data departemen dan jabatan untuk ditampilkan di dropdown
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.create', compact('departments', 'positions'));
    }

    public function store(Request $request)
    {
        // Validasi semua data dari migrasi
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees',
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,non-aktif',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function show(Employee $employee)
    {
        // Load semua relasi untuk halaman detail
        $employee->load(['department', 'position', 'salaries', 'attendances']);
        return view('employee.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        // Kirim juga data departemen dan jabatan untuk dropdown
        $departments = Department::all();
        $positions = Position::all();
        return view('employee.edit', compact('employee', 'departments', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:employees,email,' . $employee->id,
            'nomor_telepon' => 'required|string|max:15',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:aktif,non-aktif',
            'departemen_id' => 'required|exists:departments,id',
            'jabatan_id' => 'required|exists:positions,id',
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        // 'onDelete('cascade')' akan menghapus data gaji dan absensi juga
        $employee->delete();
        return redirect()->route('employees.index')
                         ->with('success', 'Data pegawai berhasil dihapus.');
    }
}