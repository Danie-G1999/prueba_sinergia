@extends('layouts.app')

@section('title', 'Iniciar sesión')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="login-card">

            <h3 class="text-center mb-4">Iniciar Sesión</h3>

            <div id="error-message" class="alert alert-danger d-none"></div>

            <form id="loginForm">

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="email" 
                        placeholder="admin@example.com"
                        required
                    >
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        id="password" 
                        placeholder="**********"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">Ingresar</button>
            </form>

        </div>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async (e) => {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    const errorMsg = document.getElementById("error-message");
    errorMsg.classList.add("d-none");

    try {
        const response = await fetch("http://127.0.0.1:8000/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (!response.ok) {
            errorMsg.textContent = data.error || "Credenciales inválidas";
            errorMsg.classList.remove("d-none");
            return;
        }

        // Guardar token en localStorage
        localStorage.setItem("token", data.access_token);

        // Redirigir a dashboard
        window.location.href = "/dashboard";

    } catch (error) {
        errorMsg.textContent = "Error de conexión con el servidor";
        errorMsg.classList.remove("d-none");
    }
});
</script>

@endsection
