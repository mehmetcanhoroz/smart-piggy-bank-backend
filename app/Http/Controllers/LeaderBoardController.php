<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LeaderBoardController extends Controller
{
    public function index(Request $request)
    {
        $top7Transaction = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::today()->addDays(-7))->orderByDesc('count')->get();
        $top30Transaction = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::today()->addDays(-30))->orderByDesc('count')->get();
        $topYearTransaction = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->where('created_at', '>', Carbon::createFromDate(Carbon::today()->year, 1, 1))->orderByDesc('count')->get();
        $topTransaction = Transaction::groupBy('user_id')->with('user')->select(['transactions.user_id', DB::raw('COUNT(id) as count')])->orderByDesc('count')->get();

        $top7Amount = User::with(['coins' => function ($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-3));
        }])->get();
//        $user = $top7Amount->first();
//        dd($user->coins->sum('value'));
        $top30Amount = User::whereHas('coins', function ($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-30));
        })->get();
        $topYearAmount = User::whereHas('coins', function ($query) {
            $query->where('coins.created_at', '>', Carbon::today()->addDays(-360))->groupBy('transaction_id');
        })->get();
//        dd($top7Amount);
        $topAmount = User::with('coins')->get();

        $mobile = false;
        if ($request->get('mobile')) {
            $mobile = true;
        }

        return view('pages.leaderboard', [
            'top7Transaction' => $top7Transaction,
            'top30Transaction' => $top30Transaction,
            'topYearTransaction' => $topYearTransaction,
            'topTransaction' => $topTransaction,
            'top7Amount' => $top7Amount,
            'top30Amount' => $top30Amount,
            'topYearAmount' => $topYearAmount,
            'topAmount' => $topAmount,
            'mobile' => $mobile,
        ]);
        //dd($top7->first()->user()->first());
    }
}
