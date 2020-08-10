<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BetSelection extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'bet_id', 'selection_id', 'odds',
    ];
}
