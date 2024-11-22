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
        return view('hirafi.index');
    }
    public function listHirafiMessages()
    {
        $hirafiId = Auth::id();

        // Fetch the last message for each conversation
        $conversations = Chat::where('sender_id', $hirafiId)
            ->orWhere('receiver_id', $hirafiId)
            ->with(['sender', 'receiver'])
            ->get()
            ->groupBy(function ($chat) use ($hirafiId) {
                return $chat->sender_id === $hirafiId ? $chat->receiver_id : $chat->sender_id;
            })
            ->map(function ($messages) {
                // Get the last message in each conversation
                return $messages->sortByDesc('created_at')->first();
            });

        return view('hirafi.chats', compact('conversations'));
    }
    public function showConversation($id)
    {
        $hirafiId = Auth::id();

        // Fetch all messages between the authenticated user and the selected user
        $messages = Chat::where(function ($query) use ($hirafiId, $id) {
            $query->where('sender_id', $hirafiId)
                  ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($hirafiId, $id) {
            $query->where('sender_id', $id)
                  ->where('receiver_id', $hirafiId);
        })->orderBy('created_at', 'asc')
          ->get();

        $otherUser = User::findOrFail($id);

        return view('hirafi.conversation', compact('messages', 'otherUser'));
    }
}
