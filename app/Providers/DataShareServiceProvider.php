<?php

namespace App\Providers;

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
        $transactionCount = Transaction::all()->count();
        $calendarCount = Transaction::all()->where('created_at', Carbon::today())->count();

        // Sharing is caring
        View::share('userCount', $userCount);
        View::share('transactionCount', $transactionCount);
        View::share('calendarCount', $calendarCount);
    }
}
