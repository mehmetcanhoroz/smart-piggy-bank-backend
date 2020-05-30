<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $userCount = User::all()->count();
            $transactions = Transaction::all();
            $transactionCount = $transactions->count();
            $calendarCount = $transactions->whereBetween('created_at', [Carbon::today(), Carbon::today()->addDay()])->count();
            $totalSaving = Coin::all()->sum('value');

            return response()->json([
                'global' => [
                    'userCount' => $userCount,
                    'transactionCount' => $transactionCount,
                    'calendarCount' => $calendarCount,
                    'totalSaving' => $totalSaving,
                ],
                'user' => [
                    'transactionCount' => \Illuminate\Support\Facades\Auth::user()->transactions->count(),
                    'weeklyTransaction' => \Illuminate\Support\Facades\Auth::user()->transactions->whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->count(),
                    'coinCount' => \Illuminate\Support\Facades\Auth::user()->coins->count(),
                    'totalSaving' => \Illuminate\Support\Facades\Auth::user()->totalSaving,
                ],
            ], 200);
            // Sharing is caring
//            View::share('userCount', $userCount);
//            View::share('transactionCount', $transactionCount);
//            View::share('calendarCount', $calendarCount);
//            View::share('totalSaving', $totalSaving);
        }
        return view('pages.index');
    }
}
