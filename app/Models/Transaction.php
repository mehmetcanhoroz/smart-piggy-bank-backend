<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    public function scopeOfLoggedUser($query, $arg = [])
    {
        $user = Auth::user();
        if ($user) {
            //return $user;
            if (!($user->is_parent == 1)) {
                //dd('parent degil');
                $query->whereNested(function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                });

            }
        }
    }

    public function coins()
    {
        return $this->hasMany(Coin::class)->orderByDesc('value');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getValueAttribute()
    {
        return $this->coins()->sum('value');
    }

    public function getIsSuccessAttribute()
    {
        return $this->unknown_item_count > 0 ? false : true;
    }
}
