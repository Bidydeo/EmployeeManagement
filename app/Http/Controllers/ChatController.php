<?php

namespace App\Http\Controllers;

use \Exception;
use App\Events\MessageDelivered;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(User $user)
    {
        return Message::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', auth()->id())
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', auth()->id());
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
    }

    public function show(User $user)
    {
        return view('chat', [
            'user' => $user
        ]);
    }

    public function getContacts()
    {
        $AuthUserId = Auth::id();

        // // Obținem utilizatorii cu ultimul mesaj și ora mesajului
        $users = User::where('id', '!=', $AuthUserId)
        ->select('id', 'name', 'avatar', 'last_active')
        ->with(['messages_sender' => function ($query) {
            $query->where('receiver_id', Auth::id())->latest()->limit(1); // Obține ultimul mesaj
        }])
        ->get();

        return view('contacts',['users'=>$users]);
    }

    public function getMessages($userId)
    {
    try {
        $messages = Message::where(function($query) use ($userId) {
                $query->where('sender_id', Auth::id())
                      ->where('receiver_id', $userId);
            })
            ->orWhere(function($query) use ($userId) {
                $query->where('sender_id', $userId)
                      ->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return response()->json($messages);
        } catch (\Exception $e) {
        // Returnează detalii ale erorii pentru debugging
        return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function sendMessage(Request $request, User $user)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'text' => $request->input('message'),
            'is_delivered' => false, // Inițial, nu este livrat
            'is_read' => false,      // Inițial, nu este citit
        ]);

        broadcast(new MessageSent($message))->toOthers();


        return response()->json($message);
    }
    public function markAsDelivered($messageId)
    {
        $message = Message::find($messageId);
        if ($message) {
            $message->is_delivered = true;
            $message->save();

            broadcast(new MessageDelivered($message)); // Event pentru livrare
        }
    }

    public function markAsRead($messageId)
    {
        $message = Message::find($messageId);
        if ($message) {
            $message->is_read = true;
            $message->save();

            broadcast(new MessageRead($message)); // Event pentru citire
        }
    }
}