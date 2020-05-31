<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class League extends Model
{
    protected $guarded = [];

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function classification()
    {
        return $this->hasOne(Classification::class);
    }
}
