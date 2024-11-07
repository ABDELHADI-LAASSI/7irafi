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

        // Get all unique hirfa values for the dropdown options
        $allHiraf = AdditionalInfo::select('hirfa')->distinct()->get();

        if ($selectedHirfa) {
            // Retrieve entries for the selected hirfa, including user names and images
            $hiraf = AdditionalInfo::where('hirfa', $selectedHirfa)
                        ->with('user:id,name') // Load only user name
                        ->get();
        } else {
            // Retrieve all entries without filtering by hirfa
            $hiraf = AdditionalInfo::with('user:id,name')->get();
        }

        return view('all.hirafiyine', compact('hiraf', 'allHiraf', 'selectedHirfa'));
    }

    public function getProfile()
    {

        

        if (Auth::check()) {
            $user = Auth::user();
            return view('all.profile' , compact('user'));
        }
            
        

    }

    public function sendUserToDashboard(){
        if (!Auth::check()) {
            return redirect('/login');
        } else {
            $user = Auth::user();
            if ($user->role == 'hirafi') {
                return redirect()->route('hirafi.index');
            } elseif ($user->role == 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role == 'user') {
                return redirect()->route('main');
            }
        }
    }



}
