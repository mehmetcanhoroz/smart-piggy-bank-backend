<?php

namespace App\Providers;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class DataShareServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
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
        View::share('userCount', $userCount);
        View::share('transactionCount', $transactionCount);
        View::share('calendarCount', $calendarCount);
        View::share('totalSaving', $totalSaving);
    }
}
