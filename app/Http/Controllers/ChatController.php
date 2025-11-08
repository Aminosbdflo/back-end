<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function show($ownerId)
    {
        $owner = User::findOrFail($ownerId);
        $currentUser = Auth::user();

        return view('chat', compact('owner', 'currentUser'));
    }

    public function getMessages($ownerId, Request $request)
    {
        $currentUserId = Auth::id();
        $lastId = $request->query('last_id', 0);

        $messages = Message::where(function ($query) use ($currentUserId, $ownerId) {
            $query->where('sender_id', $currentUserId)->where('receiver_id', $ownerId);
        })->orWhere(function ($query) use ($currentUserId, $ownerId) {
            $query->where('sender_id', $ownerId)->where('receiver_id', $currentUserId);
        })->where('id', '>', $lastId)->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendMessage(Request $request, $ownerId)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $currentUserId = Auth::id();

        $message = Message::create([
            'sender_id' => $currentUserId,
            'receiver_id' => $ownerId,
            'message' => $request->message,
        ]);

        broadcast(new \App\Events\MessageSent($message))->toOthers();

        return response()->json($message);
    }
}
