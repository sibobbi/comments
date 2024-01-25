<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Auth;
class CommentController extends Controller
{
    public function create(Request $request) {
        $comment = new Comment();
        
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;
        $comment->parent_id = $request->parent_comment_id;
        $comment->body = $request->body;
        $comment->save();

        $comment->user = Auth::user();

        return response()->json($comment,200);
    }
}
