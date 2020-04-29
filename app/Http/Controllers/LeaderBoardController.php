<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LeaderBoardController extends Controller
{
    public function index()
    {
        $top7Coins = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::today()->addDays(-7))->orderByDesc('count')->get();
        $top30Coins = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::today()->addDays(-30))->orderByDesc('count')->get();
        $topYearCoins = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::createFromDate(Carbon::today()->year, 1, 1))->orderByDesc('count')->get();
        $topCoins = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->orderByDesc('count')->get();

        $top7Amount = User::with(['coins' => function ($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-3));
        }])->get();
//        $user = $top7Amount->first();
//        dd($user->coins->sum('value'));
        $top30Amount = User::whereHas('coins', function($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-30));
        })->get();
        $topYearAmount = User::whereHas('coins', function($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-360))->groupBy('transaction_id');
        })->get();
//        dd($top7Amount);
        $topAmount = User::with('coins')->get();

        return view('pages.leaderboard', [
            'top7Coins' => $top7Coins,
            'top30Coins' => $top30Coins,
            'topYearCoins' => $topYearCoins,
            'topCoins' => $topCoins,
            'top7Amount' => $top7Amount,
            'top30Amount' => $top30Amount,
            'topYearAmount' => $topYearAmount,
            'topAmount' => $topAmount,
        ]);
        //dd($top7->first()->user()->first());
    }
}
