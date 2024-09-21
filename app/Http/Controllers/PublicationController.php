<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\UserAdmin;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicationController extends Controller
{
    public function index(Request $request)
    {
        $where = [];
        if ($request->has('title')) $where[] = ["title", "like", "%" . $request->title . "%"];
        if ($request->has('content')) $where[] = ["content", "like", "%" . $request->content . "%"];
        if ($request->has('published_by')) $where[] = ["published_by", "=", $request->input('published_by')];

        $posts = null;
        try {
            $posts = Publication::with(["published_by", "resources"])->withCount(['comments', 'reactions'])->where($where)->orderBy('created_at', 'desc')->paginate(50);
        } catch (\Exception $e) {
            return response()->json(["errors" => "Se ha producido un error al obtener las publicaciones"], 500);
        }

        if ($posts->isEmpty()) return response()->json($posts, 404);

        return response()->json($posts, 200);
    }

    public function store(Request $request)
    {
        $published_by = UserProfile::where('user_id', auth()->user()->id)->first();
        $published_by = $published_by ? $published_by->user_id : $request->published_by;
        if (!$published_by) return response()->json([], 400);

        $validateData = Validator::make($request->all(), [
            'title' => 'string|required|max:60',
            'content' => 'string|required',
            'resources' => 'array',
        ]);

        if ($validateData->fails()) {
            return response()->json(["errors" => $validateData->errors()], 400);
        }
        try {
            $publication = Publication::create([
                'title' => $request->title,
                'content' => $request->content,
                'published_by' => $published_by,
            ]);
        } catch (\Exception $e) {
            return response()->json(["errors" => "Se ha producido un error al guardar la publicación"], 500);
        }

        if ($request->has('resources')) {
            foreach ($request->resources as $resource) {
                $data = $this->getResourceData($resource);
                $publication->resources()->create([
                    'publication_id' => $publication->id,
                    'type' => $data['type'],
                    'url' => $data['url'],
                ]);
            }
        }

        return response()->json($publication, 201);
    }

    public function show($id)
    {
        if (!$id) return response()->json([], 400);
        $publication = Publication::with(["published_by", "comments", "resources"])->find($id)->loadMissing(['comments', 'reactions']);
        if ($publication) return response()->json($publication, 200);
        return response()->json([], 404);
    }

    public function update(Request $request, $id)
    {
        if (!$id) return response()->json([], 400);

        $validateData = Validator::make($request->all(), [
            'title' => 'string|required|max:60',
            'content' => 'string|required',
        ]);
        if ($validateData->fails()) return response()->json(["errors" => $validateData->errors()], 400);


        $publication = Publication::find($id)->loadMissing(['comments', 'reactions']);
        if (!$publication) return response()->json([], 404);


        if (
            auth()->user()->id !== $publication->published_by
            && !UserAdmin::where('user_id', auth()->user()->id)->exists()
        ) {
            return response()->json([], 403);
        }

        try {
            $publication->title = $request->title;
            $publication->content = $request->content;
            $publication->save();

            return response()->json($publication, 200);
        } catch (\Exception $e) {
            return response()->json(["errors" => "Se ha producido un error al actualizar la publicación"], 500);
        }
    }
    private function getResourceData($resources)
    {
        $data = [
            'type' => 'video',
            'url' => 'https://www.w3schools.com/html/mov_bbb.mp4',
        ];
        return $data;
    }
}
