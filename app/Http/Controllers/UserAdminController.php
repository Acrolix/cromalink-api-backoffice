<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\UserAdmin;
use App\Http\Requests\StoreUserAdminRequest;
use App\Http\Requests\UpdateUserAdminRequest;
use Illuminate\Http\Client\Request;

class UserAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAdmin  $userAdmin
     * @return \Illuminate\Http\Response
     */
    public function show(UserAdmin $userAdmin)
    {
        //
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
                $image = ImageHelper::resize($request->file('avatar'));
                $user->avatar = base64_encode($image->toJpeg(80));
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
    public function destroy(UserAdmin $userAdmin)
    {
        //
    }
}
