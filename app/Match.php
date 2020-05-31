<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $guarded = [];
    
    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function players()
    {
        return $this->belongsToMany(Player::class);
    }
}
