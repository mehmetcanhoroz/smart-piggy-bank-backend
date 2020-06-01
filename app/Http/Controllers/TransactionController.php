<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::ofLoggedUser()->with(['user', 'coins'])->orderBy('id','desc')->get();
        if ($request->wantsJson()) {
            return response()->json($transactions, 200);
        }
        return view('pages.transactions')->with(['transactions' => $transactions]);
    }

    public function delete($id)
    {
        //dd($request);
        $transaction = null;
        if (Auth::user()->is_parent) {
            $transaction = Transaction::find($id);
        } else {
            //$transaction = Transaction::where(['user_id' => Auth::id(), 'id' => $id])->first();
            $transaction = Auth::user()->transactions()->find($id);
        }
        if ($transaction) {
            $transaction->delete();
            return response(['message' => 'Transaction deleted successfully!'], 200);
        } else {
            return response(['message' => 'Transaction couldn\'t find, so not deleted!'], 404);
        }

    }

    public function fake()
    {
        return view('pages.fake_transaction');
    }

    public function store(Request $request)
    {
        $transaction = new Transaction();
        $coins = $request->input('coins');

        $unknown = array_filter($coins, function ($item) {
            return $item == -1;
        });
        $coins = array_filter($coins, function ($item) {
            return $item != 0 && $item != -1;
        });
        $transaction->unknown_item_count = count($unknown);
        $transaction->created_at = $request->input('date');
        $transaction->user_id = User::find($request->user)->id;
        $transaction->save();

        foreach ($coins as $coin) {
            Coin::create(
                [
                    'value' => $coin,
                    'transaction_id' => $transaction->id,
                    'created_at' => $request->input('date'),
                    'updated_at' => $request->input('date'),
                ]
            );
        }

        return redirect()->route('dashboard.transactions.index')->with('message', 'Transaction created!');
    }
}
