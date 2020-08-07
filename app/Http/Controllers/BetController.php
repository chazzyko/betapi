<?php

namespace App\Http\Controllers;

use App\Player;
use App\Rules\Balance;
use App\Rules\DuplicateSelections;
use App\Rules\MaxOdds;
use App\Rules\MaxSelections;
use App\Rules\MaxStake;
use App\Rules\MinOdds;
use App\Rules\MinSelections;
use App\Rules\MinStake;
use App\Validator\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;

class BetController extends BaseController
{
    public function store(Request $request, Validator $validator)
    {
        $player = Player::find($request->input('player_id'));

        if($player){
            $rez = $validator->make($request->all(), [
               'player_id' => [new Balance],
               'stake_amount' => [new MinStake, new MaxStake],
               'selections' => [new MinSelections, new MaxSelections],
                'id' => [new DuplicateSelections],
               'odds' => [new MinOdds, new MaxOdds ],
            ]);

            if($rez){
                return response()->json($rez, 200);
            }
        }

        return response()->json(['error' => 'Fucka was not found.'], 200);


        $player = Player::findOrFail($request->input('player_id'));

        if($player){
            $validator = Validator::make($request->all(),[
                'player_id' => ['numeric', 'required' , new Balance],
            ]);

            if($validator->fails()){
                return response()->json($validator->errors(), 200);
            }

            return response()->json(['fuck this success' => 'good fouck succc'], 200);
        }

        return response()->json(['error' => 'Fucka was not found.'], 200);
    }
}
