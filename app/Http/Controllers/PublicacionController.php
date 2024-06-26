<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // realizar una validacion de todos los campos de publicacion en el request, sin requerimiento
        $requestValid = Validator::make($request->all(), [
            'title' => 'string',
            'content' => 'string',
            'created_by' => 'exists:users,id',
        ]);

        if ($requestValid->fails()) {
            return response()->json($requestValid->errors(), 400);
        }

        $fieldsSearch = [];
        if ($request->has('title')) {
            $fieldsSearch['title'] = $request->title;
        }
        if ($request->has('content')) {
            $fieldsSearch['content'] = $request->content;
        }
        if ($request->has('created_by')) {
            $fieldsSearch['created_by'] = $request->created_by;
        }

        $publicaciones = Publicacion::where($fieldsSearch)->get();
        if ($publicaciones) {
            return response()->json($publicaciones, 200);
        }
        return response()->json([], 404);
        




        if ($request->has('created_by')) {
            $publicaciones = Publicacion::where('created_by', $request->created_by)->get();
            return response()->json($publicaciones, 200);
        }

        



        $publicaciones = Publicacion::all();
        return response()->json($publicaciones. 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestValid = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'created_by' => 'required|exists:users,id',
        ]);

        if ($requestValid->fails()) {
            return response()->json($requestValid->errors(), 400);
        }
        
        $publicacion = Publicacion::create([
            'title' => $request->title,
            'content' => $request->content,
            'created_by' => $request->created_by,
        ]);

        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idValid = Validator::make(['id' => $id], [
            'id' => 'required:number',
        ]);

        if ($idValid->fails()) {
            return response()->json($idValid->errors(), 400);
        }

        $publicacion = Publicacion::find($id);
        if ($publicacion) {
            return response()->json($publicacion, 200);
        }
        return response()->json([], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $idValid = Validator::make(['id' => $id], [
            'id' => 'required:number',
        ]);

        $requestValid = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'created_by' => 'required|exists:users,id',
        ]);

        if ($idValid->fails()) {
            return response()->json($idValid->errors(), 400);
        }

        if ($requestValid->fails()) {
            return response()->json($requestValid->errors(), 400);
        }

       
        return response()->json([], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
