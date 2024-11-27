<?php

namespace App\Http\Controllers\Hirafi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class HirafiController extends Controller
{

    public function index()
    {
        $authUserId = Auth::id();

        // Fetch users you've talked with
        $users = User::whereHas('sentMessages', function ($query) use ($authUserId) {
            $query->where('receiver_id', $authUserId);
        })->orWhereHas('receivedMessages', function ($query) use ($authUserId) {
            $query->where('sender_id', $authUserId);
        })->get();

        return view('hirafi.index', compact('users'));
    }

    public function getMessages($userId)
    {
        $authUserId = Auth::id();

        // Fetch messages between logged-in user and the selected user
        $messages = Chat::where(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $authUserId)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authUserId, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $authUserId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'html' => view('hirafi.partials.messages', compact('messages'))->render(),
        ]);
    }

    public function sendMessage(Request $request)
{
    $request->validate([
        'receiver_id' => 'required|exists:users,id',
        'message' => 'required|string',
    ]);

    Chat::create([
        'sender_id' => Auth::id(),
        'receiver_id' => $request->receiver_id,
        'message' => $request->message,
    ]);

    return response()->json(['success' => true, 'message' => 'Message sent!']);
}

}
