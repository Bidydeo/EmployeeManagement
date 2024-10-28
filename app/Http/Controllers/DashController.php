<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();

        return view('dash', compact('users'));
    }
}