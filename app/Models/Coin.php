<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    protected $fillable = ['updated_at', 'created_at', 'value', 'transaction_id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
