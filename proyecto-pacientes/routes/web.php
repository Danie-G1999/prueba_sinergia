<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

// Login view
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Dashboard view con datos
Route::get('/dashboard', [PacienteController::class, 'index'])->name('dashboard');

// CRUD pacientes
Route::post('/pacientes', [PacienteController::class, 'store'])->name('pacientes.store');
Route::put('/pacientes/{paciente}', [PacienteController::class, 'update'])->name('pacientes.update');
Route::delete('/pacientes/{paciente}', [PacienteController::class, 'destroy'])->name('pacientes.destroy');
