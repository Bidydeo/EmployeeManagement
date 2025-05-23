<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
        return view('admin.index', compact('users'));
    }
    public function profile()
    {
        return view('admin.profile');
    }
}
