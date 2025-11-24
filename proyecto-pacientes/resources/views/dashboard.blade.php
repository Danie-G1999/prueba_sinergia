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

        {{-- Titulo y botones --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="m-0">Gestión de Pacientes</h2>

            <div class="d-flex gap-2">
                
                {{-- BUSCADOR --}}
                <div class="d-flex justify-content-end">
                    <input 
                        type="text" 
                        id="searchInput" 
                        class="form-control" 
                        placeholder="Buscar..." 
                        style="width: 220px;">
                </div>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pacienteModal">
                    <i class="fa-solid fa-plus"></i> Nuevo Paciente
                </button>
            </div>
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
                        <button class="btn btn-sm btn-danger" onclick="deletePaciente({{ $p->id }}, '{{ $p->nombre1 }} {{ $p->apellido1 }}')">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- PAGINACIÓN --}}
        <div class="mt-3">
            {{ $pacientes->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const token = localStorage.getItem("token");
    if (!token) { window.location.href = "/login"; return; }

    // Logout
    document.getElementById("logoutBtn").onclick = () => {
        localStorage.removeItem("token");
        window.location.href = "/login";
    };

    // ======================================================
    // Filtro de búsqueda
    // ======================================================
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("#patientsTable tbody tr");

    searchInput.addEventListener("keyup", () => {
        let filter = searchInput.value.toLowerCase();

        tableRows.forEach(row => {
            let text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });

    // ======================================================
    // Eliminar Paciente
    // ======================================================
    const confirmDeleteModal = new bootstrap.Modal(document.getElementById("confirmDeleteModal"));
    let pacienteToDeleteId = null;

    window.deletePaciente = (id, nombre) => {
        pacienteToDeleteId = id;
        document.getElementById("confirmDeleteModal").querySelector(".modal-body").innerText =
            `¿Estás seguro de que deseas eliminar al paciente "${nombre}"?`;
        confirmDeleteModal.show();
    };

    document.getElementById("deleteConfirmBtn").onclick = async () => {
        if (!pacienteToDeleteId) return;

        try {
            const res = await fetch(`/api/pacientes/${pacienteToDeleteId}`, {
                method: "DELETE",
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            if (!res.ok) throw new Error("Error eliminando paciente");

            const row = document.querySelector(`#patientsTable tbody tr[data-id='${pacienteToDeleteId}']`);
            if (row) row.remove();

            pacienteToDeleteId = null;
            confirmDeleteModal.hide();

        } catch (err) {
            console.error(err);
            alert("Error eliminando paciente");
        }
    };
});
</script>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Estás seguro de que deseas eliminar este paciente?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="deleteConfirmBtn" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

@endsection
