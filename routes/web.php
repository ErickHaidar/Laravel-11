<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SalariesController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kita mendaftarkan rute web untuk aplikasi.
|
*/

// INI BAGIAN PENTINGNYA:
// Arahkan halaman utama ('/') untuk langsung redirect 
// ke halaman 'employees.index'
Route::get('/', function () {
    return redirect()->route('employees.index');
});

// Ini adalah rute untuk semua CRUD yang kita buat
Route::resource('departments', DepartmentController::class);
Route::resource('positions', PositionController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('salaries', SalariesController::class);
Route::resource('attendances', AttendanceController::class);