<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Image extends Model
{
    public function scopeOfLoggedUser($query, $arg = [])
    {
        $user = Auth::user();
        if ($user) {
            //return $user;
            if (!($user->is_parent == 1)) {
                //dd('parent degil');
                $query->whereNested(function ($q) use ($user) {
                    $q->whereIn('transaction_id', $user->transactions()->get('id'));
                });

            }
        }
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
