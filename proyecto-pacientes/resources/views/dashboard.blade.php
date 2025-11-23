@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <span class="navbar-brand">Panel de Control</span>
        <button class="btn btn-light" id="logoutBtn">
            <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesión
        </button>
    </div>
</nav>

<div class="container mt-5">

    <div class="card shadow p-4">
        <h2 class="text-center mb-4">Gestión de Pacientes</h2>

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
            <tbody></tbody>
        </table>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", async () => {
    const token = localStorage.getItem("token");

    if (!token) {
        window.location.href = "/login";
        return;
    }

    const loadPatients = async () => {
        try {
            const response = await fetch("/api/pacientes", {
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json"
                }
            });

            if (!response.ok) throw new Error("Error al cargar pacientes");

            const pacientes = await response.json();
            const tbody = document.querySelector("#patientsTable tbody");
            tbody.innerHTML = "";

            pacientes.forEach(p => {
                tbody.innerHTML += `
                    <tr>
                        <td>${p.id}</td>
                        <td>${p.numero_documento}</td>
                        <td>${p.nombre1} ${p.nombre2 ?? ""} ${p.apellido1} ${p.apellido2}</td>
                        <td>${p.correo}</td>
                        <td>${p.genero?.nombre ?? "-"}</td>
                        <td>${p.municipio?.nombre ?? "-"}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-2" onclick="editPaciente(${p.id})">
                                <i class="fa-solid fa-pen"></i>
                            </button>

                            <button class="btn btn-sm btn-danger" onclick="deletePaciente(${p.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });

        } catch (err) {
            console.error(err);
            alert("Error cargando pacientes");
        }
    };

    await loadPatients();


    document.getElementById("logoutBtn").onclick = () => {
        localStorage.removeItem("token");
        window.location.href = "/login";
    };

});
</script>

@endsection
