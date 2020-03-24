<?php

namespace App\Http\Controllers;

use App\Models\Image;

class TransactionProofController extends Controller
{
    public function index()
    {
        $transactionProofs = Image::all();
        return view('pages.transaction_proofs')->with(['transactionProofs' => $transactionProofs]);
    }
}
