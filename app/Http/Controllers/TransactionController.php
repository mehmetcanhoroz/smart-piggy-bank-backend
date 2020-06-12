<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Image;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::ofLoggedUser()->with(['user', 'coins'])->orderBy('id', 'desc')->get();
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

        $wishlist = DB::table('wishlists')->select(['current', 'goal', 'id', 'priority'])->whereRaw('`current` < `goal`')->orderByDesc('priority')->orderByDesc('id')->first();
        //dd($wishlist);
        if (isset($wishlist)) {
            $w = Wishlist::where('id', $wishlist->id)->first();
//            dd($w);
            if ($wishlist->current + $transaction->value <= $wishlist->goal) {
                $w->current = $wishlist->current + $transaction->value;
                $w->save();
            }
            else {
                $tempMin = ($wishlist->goal - $wishlist->current);
                $extraSaving = $transaction->value - $tempMin;
                $w->current = $w->goal;
                $w->save();

                $wishlist2 = DB::table('wishlists')->select(['current', 'goal', 'id', 'priority'])->whereRaw('`current` < `goal`')->orderByDesc('priority')->orderByDesc('id')->first();
                $w2 = Wishlist::where('id', $wishlist2->id)->first();
                $w2->current = $wishlist2->current + $extraSaving;
                $w2->save();
            }
        }
		$image = new Image;
		$image->transaction_id = $transaction->id;
		
		if(empty($request->get('image'))) {
            $image->image = 'https://image.shutterstock.com/image-photo/india-circulating-coins-collection-set-260nw-201607463.jpg';
		} else {
			$image->image = $request->get('image');
		}
		$image->save();
        return redirect()->route('dashboard.transactions.index')->with('message', 'Transaction is created!');
    }
}
