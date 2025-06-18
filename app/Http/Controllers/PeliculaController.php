<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
      public function index(Request $request)
    {
        $userId = $request->user()->id;
        $Id_genero = $request->query('Id_genero');
    
        $peliculas = Pelicula::whereHas('Id_genero', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    
        if ($Id_genero) {
            $peliculas->where('Id_genero', $Id_genero);
        }
    
        return response()->json($peliculas->get());
    }

    public function Guardar(Request $request)
    {
        $validated = $request->validate([
            'Titulo'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'Duracion'   => 'required|integer',
            'Id_genero'   => 'required|integer|exists:generos,id',
        ]);

        $pelicula = $request->user()->peliculas()->create($validated);
        return response()->json($pelicula, 201);
    }

       public function Mover (Request $request, $id)
    {
        $pelicula = $request->user()->peliculas()->find($id);
        if (!$pelicula) {
            return response()->json(['message' => 'pelicula no encontrada'], 404);
        }

        return response()->json($pelicula);
    }

        public function Eliminar(Request $request, $id)
    {
        $pelicula = $request->user()->peliculas()->find($id);
        if (!$pelicula) {
            return response()->json(['message' => 'pelicula no encontrada'], 404);
        }

        $pelicula->delete();
        return response()->json(['message' => 'pelicula eliminada']);
    }


}
