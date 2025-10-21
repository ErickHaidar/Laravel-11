<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    /**
     * INI BAGIAN PENTING:
     * Memberi tahu Laravel nama tabel yang benar adalah 'attendace' (bukan 'attendances')
     */
    protected $table = 'attendace';

    // Kolom yang boleh diisi
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    /**
     * Relasi: Satu data absensi ini milik satu karyawan
     */
    public function employee()
    {
        // 'karyawan_id' adalah foreign key di tabel 'attendace'
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}