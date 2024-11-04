<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\AdditionalInfo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function getAcceuil()
    {
        // Set the locale to Arabic
        Carbon::setLocale('ar');

        $posts = Post::paginate(10);
        foreach ($posts as $post) {
            if (Auth::check()) {
                $userId = Auth::user()->id;
                if ($post->likers->contains('id', $userId)) {
                    $post->liked = true;
                } else {
                    $post->liked = false;
                }
            }

            // Format the created_at date in Arabic
            $post->posted_at = $post->created_at->locale('ar')->diffForHumans();
            // Alternatively, use diffForHumans() for relative time
            // $post->posted_at = $post->created_at->locale('ar')->diffForHumans();
        }

        $hirafyiin = User::where('role', 'hirafi')
        ->whereHas('infos', function ($query) {
            $query->whereNotNull('image');
        })
        ->limit(10)
        ->get();


        return view('all.main', compact('posts', 'hirafyiin'));
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
