<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class TransactionProofController extends Controller
{
    public function index(Request $request)
    {
        $transactionProofs = Image::ofLoggedUser()->get();
        if ($request->wantsJson())
            return response()->json($transactionProofs, 200);
        return view('pages.transaction_proofs')->with(['transactionProofs' => $transactionProofs]);
    }
}
