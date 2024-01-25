<?php

namespace App\Http\Controllers;


use App\Models\Post;

class PostController extends Controller
{
    public function list() {
        $post = Post::find(1);
        $comments = $post->comments()->parent()->with('replies.user','user')->get();
        
        return response()->json(['comments'=> $comments , 'post' => $post],200);
    }
}
