<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_parent' => 'boolean',
    ];

    //Add extra attribute
    //    protected $attributes = ['total_saving'];
    //Make it available in the json response
    protected $appends = ['total_saving'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function coins()
    {
        return $this->hasManyThrough(Coin::class, Transaction::class);
    }

    public function transactionProofs()
    {
        return $this->hasManyThrough(Image::class, Transaction::class);
    }

    public function qTotalSaving()
    {
        return $this->hasManyThrough(Coin::class, Transaction::class)->sum('value');
    }

    public function getTotalSavingAttribute()
    {
        return round($this->coins()->sum('value'), 2);
    }
}
