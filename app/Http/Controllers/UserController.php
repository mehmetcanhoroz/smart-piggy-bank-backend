<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['transactions', 'coins'])->get();
        return view('pages.users')->with(['users' => $users]);
    }

    public function test()
    {
        return DB::table("transactions")
            ->select(DB::raw("weekday(created_at) as day_transaction"), DB::raw("(COUNT(*)) as total_transaction"))
            ->orderBy('day_transaction')
            ->groupBy('day_transaction')
            ->get();
    }
}
