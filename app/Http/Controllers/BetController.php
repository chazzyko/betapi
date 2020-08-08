<?php

namespace App\Http\Controllers;

use App\Player;
use App\Rules\Balance;
use App\Rules\DuplicateSelections;
use App\Rules\MaxOdds;
use App\Rules\MaxSelections;
use App\Rules\MaxStake;
use App\Rules\MaxWinAmount;
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
            $errors['errors'] = $validator->global($request->all(), [
               'player_id' => [new Balance],
               'stake_amount' => [new MinStake, new MaxStake],
               'selections' => [new MinSelections, new MaxSelections],
            ]);

            $errors['errors'][] = $validator->checkWin($request->all(), new MaxWinAmount);

            $errors['selections'] = $validator->local($request->input('selections'), [
                'id' => [new DuplicateSelections($request->input('selections'))],
                'odds' => [new MinOdds, new MaxOdds ],
            ]);

            if($errors){
                return response()->json($errors, 200);
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
