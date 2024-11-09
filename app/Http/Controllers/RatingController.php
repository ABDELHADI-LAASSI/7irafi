<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request ,User $user , User $hirafi) {
        $request->validate([
            'score' => 'required|integer|min:0|max:5',
        ]);

        Rating::create([
            'hirafi_id' => $hirafi->id,
            'user_id' => $user->id,
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success' , 'You rated this hirafi');
    }

    public function update(Request $request ,User $user , User $hirafi) {
        $request->validate([
            'score' => 'required|integer|min:0|max:5',
        ]);

        Rating::where('hirafi_id' , $hirafi->id)->where('user_id' , $user->id)->update([
            'score' => $request->score,
        ]);

        return redirect()->back()->with('success' , 'You rated this hirafi');
    }
}
