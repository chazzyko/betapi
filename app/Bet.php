<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    protected $fillable = [
        'player_id', 'stake_amount',
    ];
}
