<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $guarded = [];

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function responsable()
    {
        return $this->belongsTo(Player::class);
    }
}
