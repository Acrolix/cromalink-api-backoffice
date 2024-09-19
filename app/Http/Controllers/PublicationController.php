<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->has('title')) $where[] = ["title", "like", "%" . $request->title . "%"];
        if ($request->has('content')) $where[] = ["content", "like", "%" . $request->content . "%"];
        if ($request->has('user_id')) $where[] = ["published_by", "=", $request->user_id];

        $posts = [];
        try {
            $posts = Publication::with(["published_by"])->where($where)->paginate(20);
        } catch (\Exception $e) {
            return response()->json(["errors" => $e->getMessage()], 500);
        }

        if ($posts->isEmpty()) return response()->json($posts, 404);

        return response()->json($posts, 200);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
