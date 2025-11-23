@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
@include('components.paciente-modal', [
    'tipos_documento' => $tipos_documento,
    'generos' => $generos,
    'departamentos' => $departamentos
])

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Panel de Control</span>
        <button class="btn btn-light" id="logoutBtn"><i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión</button>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Gestión de Pacientes</h2>
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pacienteModal">
                <i class="fa-solid fa-plus"></i> Nuevo Paciente
            </button>
        </div>

        <table class="table table-striped table-hover align-middle" id="patientsTable">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombre completo</th>
                    <th>Correo</th>
                    <th>Género</th>
                    <th>Municipio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pacientes as $p)
                <tr data-id="{{ $p->id }}">
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->numero_documento }}</td>
                    <td>{{ $p->nombre1 }} {{ $p->nombre2 ?? '' }} {{ $p->apellido1 }} {{ $p->apellido2 }}</td>
                    <td>{{ $p->correo }}</td>
                    <td>{{ $p->genero->nombre ?? '-' }}</td>
                    <td>{{ $p->municipio->nombre ?? '-' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-2" onclick="editPaciente({{ $p->id }})">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deletePaciente({{ $p->id }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");
    if (!token) { window.location.href = "/login"; return; }

    document.getElementById("logoutBtn").onclick = () => {
        localStorage.removeItem("token");
        window.location.href = "/login";
    };
});
</script>
@endsection
