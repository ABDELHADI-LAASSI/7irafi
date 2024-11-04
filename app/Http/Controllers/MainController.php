<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\AdditionalInfo;
use App\Models\User;

class MainController extends Controller
{
    public function getAcceuil()
    {
        $posts = Post::paginate(10);
        return view('all.main' , compact('posts'));
    }
    public function getHirafiyine(Request $request)
    {
        $selectedHirfa = $request->input('hirfa');

        // Get all unique hirfa names for the dropdown options
        $allHiraf = AdditionalInfo::select('hirfa')->distinct()->get();

        if ($selectedHirfa) {
            // If a specific hirfa is selected, retrieve all entries for that hirfa, including images
            $hiraf = AdditionalInfo::where('hirfa', $selectedHirfa)
                                   ->with('user') // Assuming there's a relation defined
                                   ->get();
        } else {
            // Retrieve users with role 'hirafi' and their associated hirfa names
            $hiraf = User::where('role', 'hirafi')->get(); // Corrected model reference
        }

        return view('all.hirafiyine', compact('hiraf', 'allHiraf', 'selectedHirfa'));
    }



}
