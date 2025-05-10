<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersWithUnreadMessages
{
    public function compose(View $view)
    {
        $authUserId = Auth::id();

        $usersWithUnreadMessages = collect();

        // Verificăm dacă userul este autentificat
        if ($authUserId) {
            // Obținem utilizatorii care au mesaje necitite pentru utilizatorul autentificat
            $usersWithUnreadMessages = User::whereHas('messages_sender', function ($query) use ($authUserId) {
                $query->where('receiver_id', $authUserId)
                        ->where('is_read', false);
            })->with(['messages_sender' => function ($query) use ($authUserId) {
                $query->where('receiver_id', $authUserId)->orderBy('created_at', 'desc');
            }])->get();

            // Aici putem itera prin fiecare utilizator pentru a adăuga mesajele necitite
            $usersWithUnreadMessages = $usersWithUnreadMessages->map(function ($user) {
                $user->last_unread_message = $user->messages_sender
                    ->where('is_read', false)
                    ->sortByDesc('created_at')
                    ->first();

                return $user;
            });
        }

        // Pasăm variabila către view
        $view->with('usersWithUnreadMessages', $usersWithUnreadMessages);
    }
}
