<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use App\Models\UserAdmin;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function toggleLike(Request $request, $id)
    {
        if (!$id) return response()->json([], 400);

        $type = $request->type ?? 'MG';
        if (!in_array($type, ['MG', 'ME', 'MD'])) return response()->json([], 400);

        $isAdmin = UserAdmin::where('user_id', auth()->user()->id)->exists();
        $reaction_by = $isAdmin ? $request->reaction_by : auth()->user()->id;

        $reaction = Reaction::where('publication_id', $id)->where('reaction_by', $reaction_by)->first();

        try {
            if ($reaction) {
                $reaction->delete();
                return response()->json(["like" => false], 200);
            }

            $reaction = Reaction::create([
                'publication_id' => $id,
                'reaction_by' => $reaction_by,
                'type' => $type,
            ]);
        } catch (\Exception $e) {
            // return response()->json(["errors" => "Se ha producido un error al eliminar la reacción"], 500);
            return response()->json([$e->getMessage()], 500);
        }


        return response()->json(["like" => $reaction->type], 200);
    }
}
