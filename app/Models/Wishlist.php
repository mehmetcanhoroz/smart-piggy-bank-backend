<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    //Make it available in the json response
    protected $appends = ['is_done', 'left_percentage'];
    public function getLeftPercentageAttribute()
    {
        return (int)($this->current / $this->goal * 100);
    }

    public function getIsDoneAttribute()
    {
        return $this->current >= $this->goal;
    }
}
