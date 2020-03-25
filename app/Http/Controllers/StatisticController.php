<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function index()
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $allCountByDay = DB::table("transactions")
            ->select(DB::raw("weekday(created_at) as day_transaction"), DB::raw("(COUNT(*)) as total_transaction"))
            ->orderBy('day_transaction')
            ->groupBy('day_transaction')
            ->get();

        foreach ($allCountByDay as $day) {
            $allCountByDay->get($day->day_transaction)->day_transaction = $days[$day->day_transaction];
        }

        $allCountByMonth = DB::table("transactions")
            ->select(DB::raw("month(created_at) as month_transaction"), DB::raw("(COUNT(*)) as total_transaction"))
            ->orderBy('month_transaction')
            ->groupBy('month_transaction')
            ->get();
        /*
                for ($i = 1; $i <= 12; $i++) {
                    $shouldAdd = true;
                    for ($j = 0; $j < sizeof($allCountByMonth); $j++) {
                        if ($allCountByMonth->get($j)->month_transaction == $i) {
                            $shouldAdd = false;
                            break;
                        }
                    }
                    if ($shouldAdd) {
                        $model = new \stdClass();
                        $model->month_transaction = $i;
                        $model->total_transaction = 0;
                        $allCountByMonth->add($model);
                    }
                }*/

        //dd($allCountByMonth);


        $allCountByMonth = $allCountByMonth->sortBy('month_transaction');
        for ($i = 0; $i < sizeof($allCountByMonth); $i++) {
            $allCountByMonth->get($i)->month_transaction = $months[$allCountByMonth->get($i)->month_transaction - 1];
        }


        $allCountByCoin = DB::table('coins')
            ->select(DB::raw('count(*) as coin_count, value'))
            ->groupBy('value')
            ->orderByDesc('coin_count')
            ->get();

        $allCountByUnknown = Transaction::all()->sum('unknown_item_count');
        $allCountByCountCoin = Coin::all()->count();

        $data = [
            'monthly' => $allCountByMonth->toArray(),
            'daily' => $allCountByDay->toArray(),
            'coin' => $allCountByCoin->toArray(),
            'coinUnknown' => ['unkown_coin' => $allCountByUnknown, 'coin' => $allCountByCountCoin]
        ];

        return view('pages.statistics')->with(['data' => $data]);
    }
}
