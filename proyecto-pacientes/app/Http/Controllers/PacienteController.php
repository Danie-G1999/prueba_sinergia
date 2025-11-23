<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        return Paciente::with(['genero', 'municipio'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipo_documento,id',
            'numero_documento' => 'required',
            'nombre1' => 'required',
            'apellido1' => 'required',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'correo' => 'required|email'
        ]);

        return Paciente::create($request->all());
    }

    public function show($id)
    {
        return Paciente::with(['genero', 'municipio'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->update($request->all());

        return $paciente;
    }

    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();

        return response()->json(['message' => 'Paciente eliminado']);
    }
}
