<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Izinkan semua kolom ini diisi secara massal
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id', // Foreign key
        'jabatan_id',    // Foreign key
    ];

    // Relasi: Satu Karyawan milik SATU Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    // Relasi: Satu Karyawan milik SATU Position
    public function position()
    {
        return $this->belongsTo(Position::class, 'jabatan_id');
    }

    // Relasi: Satu Karyawan punya BANYAK Gaji
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'karyawan_id');
    }

    // Relasi: Satu Karyawan punya BANYAK Absensi
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'karyawan_id');
    }
}