<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Save;
use App\Models\User;
use Illuminate\Http\Request;

class SaveController extends Controller
{

    public function index(){
        $user = auth()->user();
        $posts = $user->savedPosts->sortByDesc('created_at');
        return view('user.saved', compact('posts'));
    }


    public function post(Request $request, Post $post) {
        $user = auth()->user();


        if (!$post->savedByUsers->contains('id', $user->id)) {
            // Create a new save entry
            Save::create([
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]);

            return redirect()->back()->with('success', 'You saved this post');
        }

        return redirect()->back()->with('error', 'You already saved this post');
    }

    public function show(Post $post) {

    }
    public function delete(Request $request, Post $post) {
        $save = Save::where('user_id' , auth()->user()->id)->where('post_id' , $post->id)->first();
        $save->delete();
        return redirect()->back()->with('success', 'You unsaved this post');
    }
}
