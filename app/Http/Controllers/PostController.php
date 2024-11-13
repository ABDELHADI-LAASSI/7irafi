<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function show($id)
{
    $post = Post::with(['user', 'likes', 'comments.user', 'user.infos'])->findOrFail($id);  
    if (Auth::check()) {
        $userId = Auth::user()->id;
        if ($post->likers->contains('id', $userId)) {
            $post->liked = true;
        } else {
            $post->liked = false;
        }
    }

    return view('post.show', compact('post'));
}

}
