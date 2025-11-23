<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;

class MunicipioController extends Controller
{
    public function getByDepartamento($departamentoId)
    {
        $municipios = Municipio::where('departamento_id', $departamentoId)->get();
        return response()->json($municipios);
    }
}
