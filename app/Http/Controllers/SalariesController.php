<?php

namespace App\Http\Controllers;

use App\Models\Salary;    // GANTI ke model Salary
use App\Models\Employee;   // Kita butuh ini untuk form dropdown
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    /**
     * Tampilkan daftar gaji
     */
    public function index()
    {
        // Ambil data gaji (dengan relasi employee), BUKAN pegawai
        $salaries = Salary::with('employee')->latest()->paginate(10);

        // Tampilkan view Gaji, BUKAN view pegawai
        return view('Salaries.index', compact('salaries'));
    }

    /**
     * Tampilkan form untuk membuat data baru
     */
    public function create()
    {
        // Ambil data pegawai (serta relasi 'position' untuk ambil gaji pokok)
        $employees = Employee::with('position')->get();
        return view('Salaries.create', compact('employees'));
    }

    /**
     * Simpan data baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10', // Format: YYYY-MM
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        // Ambil nilai, beri default 0 jika kosong
        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $gaji_pokok = $request->gaji_pokok;

        // Hitung total gaji
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        Salary::create([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil ditambahkan.');
    }

    public function show(Salary $salary)
    {
        // Load relasi employee-nya untuk ditampilkan
        $salary->load('employee');
        return view('Salaries.show', compact('salary'));
    }

    /**
     * Tampilkan form untuk mengedit data
     */
    public function edit(Salary $salary)
    {
        // $salary (data gaji yg mau diedit) sudah otomatis diambil Laravel
        $employees = Employee::with('position')->get();
        return view('Salaries.edit', compact('salary', 'employees'));
    }

    /**
     * Update data di database
     */
    public function update(Request $request, Salary $salary)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan' => 'required|string|max:10',
            'gaji_pokok' => 'required|numeric|min:0',
            'tunjangan' => 'nullable|numeric|min:0',
            'potongan' => 'nullable|numeric|min:0',
        ]);

        $tunjangan = $request->tunjangan ?? 0;
        $potongan = $request->potongan ?? 0;
        $gaji_pokok = $request->gaji_pokok;

        // Hitung ulang total gaji
        $total_gaji = ($gaji_pokok + $tunjangan) - $potongan;

        $salary->update([
            'karyawan_id' => $request->karyawan_id,
            'bulan' => $request->bulan,
            'gaji_pokok' => $gaji_pokok,
            'tunjangan' => $tunjangan,
            'potongan' => $potongan,
            'total_gaji' => $total_gaji,
        ]);

        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil diperbarui.');
    }

    /**
     * Hapus data dari database
     */
    public function destroy(Salary $salary)
    {
        $salary->delete();
        return redirect()->route('salaries.index')
            ->with('success', 'Data gaji berhasil dihapus.');
    }
}