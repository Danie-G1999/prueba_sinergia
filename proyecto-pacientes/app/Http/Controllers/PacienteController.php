<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use App\Models\Genero;
use App\Models\Departamento;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with(['genero', 'municipio'])->get();
        $generos = Genero::all();
        $departamentos = Departamento::all();
        $tipos_documento = TipoDocumento::all();

        return view('dashboard', compact(
            'pacientes', 
            'generos', 
            'departamentos', 
            'tipos_documento'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'numero_documento' => 'required',
            'nombre1' => 'required',
            'apellido1' => 'required',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'correo' => 'required|email'
        ]);

        return Paciente::create($request->all());

        // Cargar relaciones
        $paciente->load(['genero', 'municipio', 'tipoDocumento']);

        return response()->json($paciente);
    }

    public function show($id)
    {
        return Paciente::with(['genero', 'municipio'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $paciente = Paciente::findOrFail($id);

        $request->validate([
            'numero_documento' => 'required|unique:pacientes,numero_documento,'.$paciente->id,
            'tipo_documento_id' => 'required|exists:tipo_documentos,id',
            'nombre1' => 'required|string|max:255',
            'apellido1' => 'required|string|max:255',
            'genero_id' => 'required|exists:generos,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'municipio_id' => 'required|exists:municipios,id',
            'correo' => 'required|email|max:255',
        ]);

        $paciente->update($request->all());

        return response()->json($paciente);
    }

    public function destroy($id)
    {
        Paciente::findOrFail($id)->delete();

        return response()->json(['message' => 'Paciente eliminado']);
    }
}
