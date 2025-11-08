<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function index(){
        $books = Books::where('user_id', Auth::id())->with('category', 'bookType')->get();
        $totalBooks = $books->count();
        $availableBooks = Books::where('user_id', Auth::id())->where('status', 'available')->count();
        $borrowedBooks = Books::where('user_id', Auth::id())->where('status', 'borrowed')->count();

        // Get unique conversation partners
        $conversationPartners = Message::where(function ($query) {
            $query->where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id());
        })->selectRaw('CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as partner_id', [Auth::id()])
          ->distinct()
          ->pluck('partner_id');
        $conversationCount = $conversationPartners->count();

        return view('dashboard', compact('books', 'totalBooks', 'availableBooks', 'borrowedBooks', 'conversationCount'));
    }

    public function conversations(){
        $currentUserId = Auth::id();

        // Get unique conversation partners with latest message
        $conversations = Message::where(function ($query) use ($currentUserId) {
            $query->where('sender_id', $currentUserId)->orWhere('receiver_id', $currentUserId);
        })->selectRaw('CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END as partner_id', [$currentUserId])
          ->selectRaw('MAX(created_at) as latest_message_at')
          ->selectRaw('MIN(sender_id) as sender_id')
          ->selectRaw('MIN(receiver_id) as receiver_id')
          ->groupBy('partner_id', 'sender_id', 'receiver_id')
          ->orderBy('latest_message_at', 'desc')
          ->with(['sender', 'receiver'])
          ->get()
          ->map(function ($item) use ($currentUserId) {
              $partnerId = $item->partner_id;
              $partner = $item->sender_id == $currentUserId ? $item->receiver : $item->sender;
              $latestMessage = Message::where(function ($query) use ($currentUserId, $partnerId) {
                  $query->where('sender_id', $currentUserId)->where('receiver_id', $partnerId);
              })->orWhere(function ($query) use ($currentUserId, $partnerId) {
                  $query->where('sender_id', $partnerId)->where('receiver_id', $currentUserId);
              })->orderBy('created_at', 'desc')->first();

              return [
                  'partner' => $partner,
                  'latest_message' => $latestMessage,
                  'unread_count' => 0, // Placeholder, as is_read column doesn't exist in messages table
              ];
          });

        return view('conversations', compact('conversations'));
    }
}
