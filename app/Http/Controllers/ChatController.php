<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function listUserMessages()
    {
        $userId = Auth::id();

        // Fetch the last message for each conversation
        $conversations = Chat::where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->with(['sender', 'receiver'])
            ->get()
            ->groupBy(function ($chat) use ($userId) {
                // Group by the other user's ID
                return $chat->sender_id === $userId ? $chat->receiver_id : $chat->sender_id;
            })
            ->map(function ($messages) {
                // Get the last message in each conversation
                return $messages->sortByDesc('created_at')->first();
            });

        return view('user.chats', compact('conversations'));
    }
    public function showConversation($id)
    {
        $userId = Auth::id();

        // Fetch all messages between the authenticated user and the selected user
        $messages = Chat::where(function ($query) use ($userId, $id) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($userId, $id) {
            $query->where('sender_id', $id)
                  ->where('receiver_id', $userId);
        })->orderBy('created_at', 'asc')
          ->get();

        $otherUser = User::findOrFail($id);

        return view('user.conversation', compact('messages', 'otherUser'));
    }
    public function sendMessage(Request $request, $id)
    {
        $request->validate(['message' => 'required|string|max:255']);

        Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $id,
            'message' => $request->message,
        ]);

        return redirect()->route('user.chat', $id)->with('success', 'Message sent successfully');
    }

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
