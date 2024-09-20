<?php
namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function filtrar(Request $request)
    {

    }

    public function guardar(Request $request)
    {
        try {
            $publicacion = Publication::create([
                'title' => $request->title,
                'content' => $request->content,
                'image' => $request->image,
                'published_by' => $request->user_id || $request->user()->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        return response()->json($publicacion, 201);
    }

    public function obtener($id)
    {

        $publicacion = Publication::with(["published_by", "comments"])->withCount('reactions')->find($id);
        if ($publicacion) {
            return response()->json($publicacion, 200);
        }
        return response()->json([], 404);
    }

    public function actualizar(Request $request, $id)
    {
        $publicacion = Publication::find($id);
        if (!$publicacion) return response()->json([], 404);

        $publicacion->update([
            'title' => $request->title,
            'content' => $request->content,

        ]);

        return response()->json($publicacion, 200);
    }

    public function eliminar($id)
    {
        $publicacion = Publication::find($id);
        if ($publicacion) {
            $publicacion->delete();
            return response(null, 204);
        }
        return response(null, 404);
    }
}
