<?php

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($id)
    {
        $comments = Comment::where(['publication' => $id])->get();
        return response()->json($comments);
    }
}