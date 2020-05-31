<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    protected $guarded = [];
    
    public function league()
    {
        return $this->belongsTo(League::class);
    }

}
