<?php

namespace App\Http\Controllers;

use App\helpers\ImageHelper;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use App\Models\UserAdmin;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $where = null;
        if ($request->has('first_name')) $where[] = ["first_name", "like", "%" . $request->first_name . "%"];
        if ($request->has('last_name')) $where[] = ["last_name", "like", "%" . $request->last_name . "%"];
        if ($request->has('country_code')) $where[] = ["country_code", "=", $request->country_code];

        $users = null;
        try {
            $users = UserProfile::with(["country"])->withCount(['publications', 'comments', 'reactions'])->where($where)->paginate(50);
        } catch (\Exception $e) {
            // return response()->json(["errors" => "Se ha producido un error al obtener los usuarios"], 500);
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        if ($users->isEmpty()) return response()->json($users, 404);

        return response()->json($users, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            if (!$id) return response()->json([], 404);


            $user = UserProfile::with(["country", "publications"])->where(['user_id' => $id])->get();
            if (!$user->count()) return response()->json([], 404);
            return response()->json($user, 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Se produjo un error, pónganse en contacto con un administrador"], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserProfileRequest $request, $id)
    {
        try {
            $user = UserProfile::find($id);
            if (!$user) return response()->json(['message' => 'No se encontró el usuario'], 404);

            if ($request->hasFile('avatar')) {
                $image = ImageHelper::saveAvatar($request->file('avatar'));
                $user->avatar = $image;
            }

            $request->first_name && $user->first_name = $request->first_name;
            $request->last_name && $user->last_name = $request->last_name;
            $request->biography && $user->biography = $request->biography;
            $request->country_code && $user->country_code = $request->country_code;

            $user->save();
            return response()->json(['message' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el perfil del usuario'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!UserAdmin::where('user_id', auth()->user()->id)->exists()) return response(null, 403);
        $user = UserProfile::where('user_id', $id)->get();
        if (!$user->count()) return response(null, 404);

        $user->delete();

        return response(['message' => "Usuario eliminado correctamente"], 204);
    }
}
