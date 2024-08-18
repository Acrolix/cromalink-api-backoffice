<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function filtrar(Request $request)
    {
        $where = [];
        if ($request->has('titulo')) $where[] = ["title", "like", "%" . $request->titulo . "%"];
        if ($request->has('contenido')) $where[] = ["content", "like", "%" . $request->contenido . "%"];
        if ($request->has('usuario')) $where[] = ["created_by", "=", $request->usuario];

        $publicaciones = [];
        try {
            $publicaciones = Publicacion::with(["created_by", "comments", "reactions"])->where($where)->paginate(20);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        if ($publicaciones->isEmpty()) return response()->json($publicaciones, 404);

        return response()->json($publicaciones, 200);
    }

    public function guardar(Request $request)
    {
        try {
            $publicacion = Publicacion::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'created_by' => $request->created_by,
            ]);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        return response()->json($publicacion, 201);
    }

    public function obtener($id)
    {

        $publicacion = Publicacion::with(["created_by", "comments"])->withCount('reactions')->find($id);
        if ($publicacion) {
            return response()->json($publicacion, 200);
        }
        return response()->json([], 404);
    }

    public function actualizar(Request $request, $id)
    {
        $publicacion = Publicacion::find($id);
        if (!$publicacion) return response()->json([], 404);

        $publicacion->update([
            'title' => $request->title,
            'content' => $request->content,

        ]);

        return response()->json($publicacion, 200);
    }

    public function eliminar($id)
    {
        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            $publicacion->delete();
            return response(null, 204);
        }
        return response(null, 404);
    }
}
