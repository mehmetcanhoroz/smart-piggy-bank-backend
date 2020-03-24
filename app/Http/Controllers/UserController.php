<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['transactions', 'coins'])->get();
        return view('pages.users')->with(['users' => $users]);
    }

    public function test()
    {
        $users = User::first();
        return ($users);
    }
}
