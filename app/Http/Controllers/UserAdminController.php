<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\UserAdmin;
use App\Http\Requests\StoreUserAdminRequest;
use App\Http\Requests\UpdateUserAdminRequest;
use Illuminate\Support\Facades\Request;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = UserAdmin::with('user')->paginate(10);
            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener los usuarios'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAdmin  $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(UserAdmin $userAdmin)
    {
        $userAdmin->load('user');
        return response()->json($userAdmin, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserAdminRequest  $request
     * @param  \App\Models\UserAdmin  $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserAdminRequest $request)
    {
        try {
            $user = UserAdmin::find($request->user()->id);
            if (!$user) return response()->json(['message' => 'No se encontró el usuario'], 404);

            if ($request->hasFile('avatar')) {
                $image = ImageHelper::saveAvatar($request->file('avatar'));
                $user->avatar = $image;
            }

            $request->first_name && $user->first_name = $request->first_name;
            $request->last_name && $user->last_name = $request->last_name;

            $user->save();
            return response()->json(['message' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el perfil del usuario'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAdmin  $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            if ($request->user()->profile() != 'Admin')
                return response()->json(['message' => 'No tienes permisos para realizar esta acción'], 403);
            $user = UserAdmin::find($id);
            if (!$user) return response()->json(['message' => 'No se encontró el usuario'], 404);

            // $user->delete();
            return response()->json(['message'=> 'Se elimino al usuario correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario'], 500);
        }
    }
}
