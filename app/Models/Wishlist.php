<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //Make it available in the json response
    protected $appends = ['is_done'];
    public function getLeftPercentageAttribute()
    {
        return (int)($this->current / $this->goal * 100);
    }

    public function getIsDoneAttribute()
    {
        return $this->current >= $this->goal;
    }
}
