<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {
        // Validate the request data
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
    
        // Get the authenticated user
        $user = auth()->user();
    
        // Create the comment associated with the post
        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->content,
            'date_commented' => now(), // Ensure this field exists in the comments table
        ]);
    
        return redirect()->back()->with('success', 'Comment created successfully.');
    }
    
}
