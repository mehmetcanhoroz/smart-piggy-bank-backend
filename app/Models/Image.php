<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
