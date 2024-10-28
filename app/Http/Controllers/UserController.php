<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
        return view('users.index', compact('users'));
    }
    public function getContacts()
    {
        $AuthUserId = Auth::id();

        // // Obținem utilizatorii cu ultimul mesaj și ora mesajului
        $users = User::where('id', '!=', $AuthUserId)
        ->select('id', 'name', 'avatar', 'last_active')
        ->with(['messages_sender' => function ($query) {
            $query->latest()->limit(1); // Obține ultimul mesaj
        }])
        ->get();

        return response()->json($users);
    }
}
