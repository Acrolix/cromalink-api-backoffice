<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{

    public function listar($id)
    {
        $comentarios = Comentario::where('publication_id', $id)->orderBy('created_at')->get();

        if ($comentarios->isEmpty()) return response()->json([], 404);

        return response()->json($comentarios, 200);
    }

    public function guardar(Request $request)
    {
        try {
            $comentario = Comentario::create([
                'publication_id' => $request->publication_id,
                'created_by' => $request->created_by,
                'content' => $request->content,
            ]);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        return response()->json($comentario, 201);
    }

    public function actualizar(Request $request, $id)
    {
        $comentario = Comentario::find($id);
        if (!$comentario) return response()->json([], 404);

        $comentario->update([
            'content' => $request->content,
        ]);

        return response()->json($comentario, 200);
    }

    public function eliminar($id)
    {
        $comentario = Comentario::find($id);
        if (!$comentario) return response(404);

        $comentario->delete();

        return response(null, 204);
    }
}
