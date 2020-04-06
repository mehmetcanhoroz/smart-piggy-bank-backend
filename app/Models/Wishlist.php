<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    public function getLeftPercentageAttribute()
    {
        return (int)($this->current / $this->goal * 100);
    }

    public function getIsDoneAttribute()
    {
        return $this->current >= $this->goal;
    }
}
