<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function listar($id)
    {
        $comentarios = Comment::where('publication_id', $id)->with('created_by')->orderBy('created_at')->get();

        if ($comentarios->isEmpty()) return response()->json([], 404);

        return response()->json($comentarios, 200);
    }

    public function guardar(Request $request)
    {
        try {
            $comentario = Comment::create([
                'publication_id' => $request->publication_id,
                'published_by' => $request->published_by ?? Auth::user()->id,
                'content' => $request->content,
            ]);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        return response()->json($comentario, 201);
    }

    public function actualizar(Request $request, $id)
    {
        $comentario = Comment::find($id);
        if (!$comentario) return response()->json([], 404);

        $comentario->update([
            'content' => $request->content,
        ]);

        return response()->json($comentario, 200);
    }

    public function eliminar($id)
    {
        $comentario = Comment::find($id);
        if (!$comentario) return response(404);

        $comentario->delete();

        return response(null, 204);
    }
}