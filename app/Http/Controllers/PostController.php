<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show($id){
        $post = Post::where('id', $id)->with('comments','comments.user','likes','likes.user')->first();
        $user = Auth::user();
        return view('posts.show',['post' => $post, 'user' => $user]);
    }
}
