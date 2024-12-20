<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\RequestWork;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'string|max:255',
            'address' => 'string|max:255|nullable',
            'phone_number' => 'string|max:255|nullable',
            'hirfa' => 'string|max:255|nullable',
            'date_of_birth' => 'date|nullable',
            'gender' => 'string|max:255|nullable',
            'city' => 'string|max:255|nullable',
            'biography' => 'string|max:255|nullable',
            'availability' => 'string|max:255|nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);

        $user = auth()->user();

        $user->name = $request->name;
        $user->infos->address = $request->address;
        $user->infos->phone_number = $request->phone_number;
        $user->infos->hirfa = $request->hirfa;
        $user->infos->date_of_birth = $request->date_of_birth;
        $user->infos->gender = $request->gender;
        $user->infos->city = $request->city;
        $user->infos->biography = $request->biography;
        if ($request->has('availability')) {
            if ($request->availability == 'true') {
                $user->infos->availability = true;
            } else {
                $user->infos->availability = false;
            }
        }

        if ($request->hasFile('image')) {
            $user->infos->image = $request->file('image')->store('images', 'public');
        }

        $user->save();
        $user->infos->save();

        return back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Current password does not match');
        };

        auth()->user()->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password updated successfully');

    }

    public function removeAccount(Request $request){
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');

    }

    public function show(User $user){
        $userId = Auth::user()->id;
        $rates = $user->rates()->get();
        $alreadyRated = false;

        $score = 0;
        foreach ($rates as $rate) {
            $score += $rate->score;
            if ($rate->user_id == $userId) {
                $alreadyRated = true;
            }
        }

        if (count($rates) > 0) {
            $score = $score / $user->rates()->count();
        }

        $score = number_format($score, 2);

        $user->rating = $score;

        // dd($alreadyRated);
        return view('all.userInfo ' , compact('user','alreadyRated'));
    }


    public function userHirafiChat(User $user) {
        $userId = Auth::user()->id;
        $hirafiId = $user->id;

        $chat = Chat::where(function($query) use ($userId, $hirafiId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $hirafiId);
        })->orWhere(function($query) use ($userId, $hirafiId) {
            $query->where('sender_id', $hirafiId)
                  ->where('receiver_id', $userId);
        })->orderBy('timestamp', 'asc') // Order messages by timestamp (oldest first)
        ->get();



        return view('all.userInfoChat' , compact('user' , 'chat' , 'hirafiId' , 'userId'));

    }

    public function get_workRequest(User $user){

        $requests = RequestWork::where('hirafi_id' , $user->id)->where('user_id' , auth()->user()->id)->get();


        return view('all.workRequest' , compact('user' , 'requests'));
    }

    public function sendWorkRequest(Request $request , User $user){
        $request->validate([
            'description' => 'required|string|max:255',
        ]);

        RequestWork::create([
            'user_id' => auth()->user()->id,
            'hirafi_id' => $user->id,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Work request sent successfully');
    }

    public function deleteWorkRequest(RequestWork $requestWork){

        $requestWork->delete();

        return back()->with('success', 'Work request deleted successfully');
    }
}