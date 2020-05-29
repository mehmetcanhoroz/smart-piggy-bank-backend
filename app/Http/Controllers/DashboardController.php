<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $userCount = User::all()->count();
            $transactions = Transaction::all();
            //$transactionCount = Transaction::all()->count();
            $transactionCount = $transactions->count();
            //$calendarCount = Transaction::all()->where('created_at', Carbon::today())->count();
            //dd(Carbon::today());
            $calendarCount = $transactions->whereBetween('created_at', [Carbon::today(), Carbon::today()->addDay()])->count();
            $totalSaving = Coin::all()->sum('value');
            //dd($totalSaving);

            // Sharing is caring
//            View::share('userCount', $userCount);
//            View::share('transactionCount', $transactionCount);
//            View::share('calendarCount', $calendarCount);
//            View::share('totalSaving', $totalSaving);
        }
        return view('pages.index');
    }
}
