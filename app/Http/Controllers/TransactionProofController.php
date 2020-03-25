<?php

namespace App\Http\Controllers;

use App\Models\Image;

class TransactionProofController extends Controller
{
    public function index()
    {
        $transactionProofs = Image::ofLoggedUser()->get();
        return view('pages.transaction_proofs')->with(['transactionProofs' => $transactionProofs]);
    }
}
