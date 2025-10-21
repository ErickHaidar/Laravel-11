<?php

namespace App\Http\Controllers;

use App\Models\Attendance; // GANTI ke model Attendance
use App\Models\Employee;   // Kita butuh ini untuk form
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Tampilkan daftar absensi
     */
    public function index()
    {
        // Ambil data absensi, BUKAN pegawai
        // Gunakan 'with' (Eager Loading) untuk mengambil data relasi 'employee'
        $attendances = Attendance::with('employee')->latest()->paginate(10);

        // Tampilkan view absensi, BUKAN view pegawai
        return view('Attendance.index', compact('attendances'));
    }

    /**
     * Tampilkan form untuk membuat data baru
     */
    public function create()
    {
        // Ambil semua pegawai untuk ditampilkan di dropdown
        $employees = Employee::all();
        return view('Attendance.create', compact('employees'));
    }

    /**
     * Simpan data baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil ditambahkan.');
    }

    public function show(Attendance $attendance)
    {
        // Load relasi employee-nya
        $attendance->load('employee');
        return view('Attendance.show', compact('attendance'));
    }

    /**
     * Tampilkan form untuk mengedit data
     */
    public function edit(Attendance $attendance)
    {
        $employees = Employee::all();
        return view('Attendance.edit', compact('attendance', 'employees'));
    }

    /**
     * Update data di database
     */
    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($request->all());

        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil diperbarui.');
    }

    /**
     * Hapus data dari database
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')
            ->with('success', 'Data absensi berhasil dihapus.');
    }
}