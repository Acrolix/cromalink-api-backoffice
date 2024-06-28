<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use App\Models\User;
use Illuminate\Http\Request;

class ReaccionController extends Controller
{

    public function setLike(Request $request)
    {
        $user = $request->reaction_by;
        $publication = Publicacion::find($request->publication_id);

        if(!$publication) return response()->json([], 404);

        $publication->reactions()->create([
            'reaction_by' => $user,
        ]);

        return response()->json([], 201);
    }

    public function unsetLike(Request $request, $id)
    {
        $user = User::find($request->reaction_by);
        $publication = Publicacion::find($id);
        
        if(!$user || !$publication) return response()->json([], 400);

        $publication->reactions()->where('reaction_by', $user->id)->delete();

        return response(null, 204);
    }
}
