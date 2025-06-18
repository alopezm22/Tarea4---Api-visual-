<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
     public function GeneroUser (Request $request)
    {
        $genero = $request->user()->genero()->get();
        return response()->json($genero);
    }

     public function Guardar(Request $request)
    {
        $validated = $request->validate([
            'Titulo' => 'required|string|max:255',
        ]);

        $genero = $request->user()->generos()->create($validated);
        return response()->json($genero, 201);
    }

     public function Eliminar(Request $request, $id)
    {
        $genero = $request->user()->generos()->find($id);
        if (!$genero) {
            return response()->json(['message' => 'Genero no encontrada'], 404);
        }

        $genero->delete();
        return response()->json(['message' => 'Genero eliminada']);
    }



}
