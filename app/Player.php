<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function matches()
    {
        return $this->belongsToMany(Match::class);
    }

    public function responsedCourts()
    {
        return $this->hasMany(Court::class);
    }
}
