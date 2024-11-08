<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function post(Request $request , Post $post , User $user) {
        if (!$post->likers->contains('id' , $user->id)) {
            Like::create([
                'user_id' => $user->id,
                'post_id' => $post->id
            ]);

            return redirect()->back()->with('success' , 'You liked this post');
        }

        return redirect()->back()->with('error' , 'You already liked this post');
    }

    public function delete(Request $request , Post $post , User $user) {
            $like = Like::where('user_id' , $user->id)->where('post_id' , $post->id)->first();
            $like->delete();

            return redirect()->back()->with('success' , 'You unliked this post');
    }
}
