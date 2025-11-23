<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PacienteController;

// Rutas públicas
Route::post('login', [AuthController::class, 'login']);

// Rutas protegidas por JWT
Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);

    // CRUD de pacientes
    Route::get('pacientes', [PacienteController::class, 'index']);
    Route::post('pacientes', [PacienteController::class, 'store']);
    Route::get('pacientes/{id}', [PacienteController::class, 'show']);
    Route::put('pacientes/{id}', [PacienteController::class, 'update']);
    Route::delete('pacientes/{id}', [PacienteController::class, 'destroy']);
});
