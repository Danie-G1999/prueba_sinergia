# 👋 ¡Hola! Bienvenidos a mi prueba técnica

Mi nombre es **Juan Daniel Guzman** y este repositorio contiene el desarrollo completo de la prueba técnica solicitada.  
El propósito de este repositorio es mostrar tanto el análisis técnico como la implementación funcional realizada en **Laravel**.

---

## 📁 Estructura del repositorio

El repositorio está organizado de la siguiente forma:

/proyecto-pacientes

/respuestas-tecnicas



### 📌 **1. respuestas-tecnicas/**
Aquí encontrarás los archivos correspondientes a las **preguntas técnicas** de la prueba.  
Todo está documentado de forma clara y organizada.

### 📌 **2. proyecto-pacientes/**
Esta carpeta contiene el **proyecto Laravel completamente funcional**, donde se desarrolló:

- CRUD de pacientes  
- Autenticación con token (login)  
- Modales para crear, editar y eliminar  
- Tabla con paginación  
- Buscador en vivo  
- UI responsive y limpia  
- API funcional y protegida por tokens

---

## ⚙️ Instalación del proyecto Laravel

Para ejecutar correctamente el proyecto dentro de `/proyecto-pacientes`, sigue estos pasos:

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/Danie-G1999/prueba_sinergia
```

### 2️⃣ Entrar a la carpeta del proyecto Laravel

```bash
cd proyecto-pacientes
```

### 3️⃣ Instalar dependencias

```bash
composer install
```

### 4️⃣ Crear archivo .env

```bash
cp .env.example .env
```

### 5️⃣ Generar la key de la aplicación

```bash
php artisan key:generate
```

### 6️⃣ Configurar base de datos

Edita tu archivo .env con tus credenciales MySQL.

### 7️⃣ Ejecutar migraciones

```bash
php artisan migrate
```

### 8️⃣ Ejecutar seeders

```bash
php artisan db:seed
```

### 9️⃣ Levantar el servidor

```bash
php artisan serve
```
