<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function store(Request $request , User $sender , User $recived) {
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        Chat::create([
            'sender_id' => $sender->id,
            'receiver_id' => $recived->id,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success' , 'Message sent successfully');
    }

}
