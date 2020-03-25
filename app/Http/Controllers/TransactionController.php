<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::ofLoggedUser()->with(['user', 'coins'])->get();
        return view('pages.transactions')->with(['transactions' => $transactions]);
    }

    public function delete($id)
    {
        //dd($request);
        $transaction = null;
        if (Auth::user()->isParent) {
            $transaction = Transaction::find($id);
        } else {
            $transaction = Transaction::where(['user_id' => Auth::id(), 'id' => $id])->first();
        }
        if ($transaction) {
            $transaction->delete();
            return response(['message' => 'Transaction deleted successfully!'], 200);
        } else {
            return response(['message' => 'Transaction couldn\'t find, so not deleted!'], 404);
        }

    }
}
