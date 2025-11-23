<div class="modal fade" id="pacienteModal" tabindex="-1" aria-labelledby="pacienteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="pacienteModalLabel">Crear Paciente</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form id="pacienteForm">
          @csrf
          <div class="modal-body">
              <div class="row g-3">
                  <!-- Tipo Documento -->
                  <div class="col-md-6">
                      <label class="form-label">Tipo Documento</label>
                      <select class="form-select" name="tipo_documento_id" required>
                          <option value="">Seleccione</option>
                          @foreach($tipos_documento as $t)
                              <option value="{{ $t->id }}">{{ $t->nombre }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Número Documento -->
                  <div class="col-md-6">
                      <label class="form-label">Número Documento</label>
                      <input type="text" class="form-control" name="numero_documento" required>
                  </div>

                  <!-- Nombre y Apellido -->
                  <div class="col-md-6">
                      <label class="form-label">Primer Nombre</label>
                      <input type="text" class="form-control" name="nombre1" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label">Segundo Nombre</label>
                      <input type="text" class="form-control" name="nombre2">
                  </div>

                  <div class="col-md-6">
                      <label class="form-label">Primer Apellido</label>
                      <input type="text" class="form-control" name="apellido1" required>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label">Segundo Apellido</label>
                      <input type="text" class="form-control" name="apellido2">
                  </div>

                  <!-- Género -->
                  <div class="col-md-6">
                      <label class="form-label">Género</label>
                      <select class="form-select" name="genero_id" required>
                          <option value="">Seleccione</option>
                          @foreach($generos as $g)
                              <option value="{{ $g->id }}">{{ $g->nombre }}</option>
                          @endforeach
                      </select>
                  </div>

                  <!-- Departamento y Municipio -->
                  <div class="col-md-6">
                      <label class="form-label">Departamento</label>
                      <select class="form-select" name="departamento_id" id="departamentoSelect" required>
                          <option value="">Seleccione</option>
                          @foreach($departamentos as $d)
                              <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label">Municipio</label>
                      <select class="form-select" name="municipio_id" id="municipioSelect" required>
                          <option value="">Seleccione un departamento primero</option>
                      </select>
                  </div>

                  <!-- Correo -->
                  <div class="col-md-6">
                      <label class="form-label">Correo</label>
                      <input type="email" class="form-control" name="correo" required>
                  </div>
              </div>
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const deptSelect = document.getElementById("departamentoSelect");
    const muniSelect = document.getElementById("municipioSelect");
    const pacienteForm = document.getElementById("pacienteForm");
    const pacienteModal = new bootstrap.Modal(document.getElementById("pacienteModal"));
    const submitBtn = pacienteForm.querySelector("button[type='submit']");
    const tbody = document.querySelector("#patientsTable tbody");
    let editingPacienteId = null;

    const token = localStorage.getItem("token");
    if (!token) {
        window.location.href = "/login";
        return;
    }

    // Cargar municipios dinámicamente
    deptSelect.addEventListener("change", async () => {
        const deptId = deptSelect.value;
        muniSelect.innerHTML = `<option value="">Cargando...</option>`;
        try {
            const res = await fetch(`/api/municipios/${deptId}`, {
                headers: { "Authorization": "Bearer " + token, "Accept": "application/json" }
            });
            const data = await res.json();
            muniSelect.innerHTML = `<option value="">Seleccione</option>`;
            data.forEach(m => {
                muniSelect.innerHTML += `<option value="${m.id}">${m.nombre}</option>`;
            });
        } catch {
            muniSelect.innerHTML = `<option value="">Error cargando municipios</option>`;
        }
    });

    // Función para abrir modal en edición
    window.editPaciente = async (id) => {
        try {
            const res = await fetch(`/api/pacientes/${id}`, {
                headers: { "Authorization": "Bearer " + token, "Accept": "application/json" }
            });
            if (!res.ok) throw new Error("No se pudo cargar el paciente");
            const paciente = await res.json();

            editingPacienteId = paciente.id;
            pacienteModal.show();
            document.getElementById("pacienteModalLabel").innerText = "Editar Paciente";
            submitBtn.innerText = "Actualizar";

            // Llenar campos
            pacienteForm.numero_documento.value = paciente.numero_documento;
            pacienteForm.nombre1.value = paciente.nombre1;
            pacienteForm.nombre2.value = paciente.nombre2 ?? '';
            pacienteForm.apellido1.value = paciente.apellido1;
            pacienteForm.apellido2.value = paciente.apellido2 ?? '';
            pacienteForm.correo.value = paciente.correo;
            pacienteForm.tipo_documento_id.value = paciente.tipo_documento_id;
            pacienteForm.genero_id.value = paciente.genero_id;
            pacienteForm.departamento_id.value = paciente.departamento_id;

            // Cargar municipios del departamento
            const muniRes = await fetch(`/api/municipios/${paciente.departamento_id}`, {
                headers: { "Authorization": "Bearer " + token, "Accept": "application/json" }
            });
            const municipios = await muniRes.json();
            muniSelect.innerHTML = `<option value="">Seleccione</option>`;
            municipios.forEach(m => {
                muniSelect.innerHTML += `<option value="${m.id}" ${m.id === paciente.municipio_id ? "selected" : ""}>${m.nombre}</option>`;
            });

        } catch (err) {
            console.error(err);
            alert("Error cargando paciente");
        }
    };

    // Crear / actualizar paciente
    pacienteForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(pacienteForm);
        const data = Object.fromEntries(formData.entries());

        let url = editingPacienteId ? `/api/pacientes/${editingPacienteId}` : "/api/pacientes";
        let method = editingPacienteId ? "PUT" : "POST";

        try {
            const res = await fetch(url, {
                method,
                headers: {
                    "Authorization": "Bearer " + token,
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify(data)
            });
            if (!res.ok) {
                const err = await res.json();
                console.error(err);
                alert("Error en la operación");
                return;
            }
            const paciente = await res.json();

            if (editingPacienteId) {
                const row = tbody.querySelector(`tr[data-id="${editingPacienteId}"]`);
                row.innerHTML = `
                    <td>${paciente.id}</td>
                    <td>${paciente.numero_documento}</td>
                    <td>${paciente.nombre1} ${paciente.nombre2 ?? ""} ${paciente.apellido1} ${paciente.apellido2}</td>
                    <td>${paciente.correo}</td>
                    <td>${paciente.genero?.nombre ?? "-"}</td>
                    <td>${paciente.municipio?.nombre ?? "-"}</td>
                    <td>
                        <button class="btn btn-sm btn-warning me-2" onclick="editPaciente(${paciente.id})"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-danger" onclick="deletePaciente(${paciente.id})"><i class="fa-solid fa-trash"></i></button>
                    </td>
                `;
            } else {
                tbody.innerHTML += `
                    <tr data-id="${paciente.id}">
                        <td>${paciente.id}</td>
                        <td>${paciente.numero_documento}</td>
                        <td>${paciente.nombre1} ${paciente.nombre2 ?? ""} ${paciente.apellido1} ${paciente.apellido2}</td>
                        <td>${paciente.correo}</td>
                        <td>${paciente.genero?.nombre ?? "-"}</td>
                        <td>${paciente.municipio?.nombre ?? "-"}</td>
                        <td>
                            <button class="btn btn-sm btn-warning me-2" onclick="editPaciente(${paciente.id})"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn btn-sm btn-danger" onclick="deletePaciente(${paciente.id})"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                `;
            }

            pacienteForm.reset();
            editingPacienteId = null;
            submitBtn.innerText = "Guardar";
            pacienteModal.hide();
        } catch (err) {
            console.error(err);
            alert("Error en la petición");
        }
    });
});
</script>
