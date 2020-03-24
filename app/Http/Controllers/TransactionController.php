<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['user', 'coins'])->get();
        return view('pages.transactions')->with(['transactions' => $transactions]);
    }

    public function delete(Request $request)
    {
        $transaction = null;
        if (Auth::user()->isParent) {
            $transaction = Transaction::find($request->id);
        } else {
            $transaction = Transaction::where(['user_id' => Auth::id(), 'id' => $request->id]);
        }
        if ($transaction) {
            $transaction->delete();
            return response(['message' => 'Transaction deleted successfully!'], 200);
        } else {
            return response(['message' => 'Transaction couldn\'t find, so not deleted!'], 404);
        }

    }
}
