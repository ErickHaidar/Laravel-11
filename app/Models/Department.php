<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi secara massal
    protected $fillable = ['nama_departemen'];

    // Relasi: Satu Department punya BANYAK Employee
    /**
     * Relasi: Satu Department punya BANYAK Employee
     * Kita harus beritahu Laravel nama foreign key-nya adalah 'departemen_id'
     */
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}