<?php

namespace App\Http\Controllers;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:30',
            'country_code' => 'required|string|max:4',
            'biography' => 'text',
            'birth_date' => 'date|required',
            'username' => 'required|string|max:20',
            'avatar' => 'url',
        ]);

        if ($validateData->fails()) {
            return response()->json(["errors" => $validateData->errors()], 400);
        }

        try {
            DB::beginTransaction();

            $user = User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'active' => true,
            ]);
            $userProfil = UserProfile::create([
                'user_id' => $user->id,
                'username' => $request->username,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'biography' => $request->biography,
                'birth_date' => $request->birth_date,
                'country_code' => $request->country_code,
                'avatar' => $request->avatar,
            ])->with('user');

            $user->sendEmailVerificationNotification();
            $user->email_verified_at = now();
            $user->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(["errors" => "Se ha producido un error al guardar el usuario"], 500);
        }

        return response()->json($userProfil, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$id) return response()->json([], 404);


        $user = UserProfile::with(["country", "publications"])->where(['user_id' => $id])->get();
        if (!$user->count()) return response()->json([], 404);
        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'first_name' => 'string|max:30',
            'last_name' => 'string|max:30',
            'country_code' => 'string|max:4',
            'biography' => 'text',
            'avatar' => 'url',
        ]);

        if ($validateData->fails()) {
            return response()->json(["errors" => $validateData->errors()], 400);
        }

        $user = UserProfile::find($id);
        if (!$user) return response()->json([], 404);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'country_code' => $request->country_code,
            'biography' => $request->biography,
            'avatar' => $request->avatar,
        ]);

        return response()->json($user, 200);

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

        return response(null, 204);
    }
}
