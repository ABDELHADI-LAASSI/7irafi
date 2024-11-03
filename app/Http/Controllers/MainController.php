<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getAcceuil()
    {
        $posts = Post::paginate(10);
        return view('all.main' , compact('posts'));
    }
}
