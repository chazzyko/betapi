<?php

namespace App\Http\Controllers;


use App\Bet;
use App\Player;
use App\BetSelection;
use App\BalanceTransaction;
use App\Rules\Balance;
use App\Rules\MinStake;
use App\Rules\MaxStake;
use App\Rules\MinOdds;
use App\Rules\MaxOdds;
use App\Rules\MinSelections;
use App\Rules\MaxSelections;
use App\Rules\MaxWinAmount;
use App\Rules\BetslipMismatch;
use App\Rules\DuplicateSelections;
use App\Rules\Unknown;
use App\Validator\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\DB;

class BetController extends BaseController
{
    public function store(Request $request, Validator $validator)
    {
        if ($request->input('player_id')) {
            $player = Player::sharedLock()->firstOrCreate(["player_id" => $request->input('player_id')]);
        }

        $errors = $validator->global($request->all(), [
            'stake_amount' => [new BetslipMismatch, new MinStake, new MaxStake],
            'player_id' => [new BetslipMismatch, new Balance],
            'selections' => [new BetslipMismatch, new MinSelections, new MaxSelections],
        ]);

        $errors = $validator->checkWin($request->all(), new MaxWinAmount);

        $errors = $validator->checkSelection($request->all(), [
            'id' => [new DuplicateSelections],
            'odds' => [new MinOdds, new MaxOdds],
        ]);

        if ($errors) {
            return response()->json($errors, 400);
        }

        DB::beginTransaction();

        try {
            $newBalance = 0;
            $player = Player::lockForUpdate()->where("player_id", $request->input('player_id'))->first();

            $bet = new Bet();
            $bet->lockForUpdate();

            $bet->player_id = $player->id;
            $bet->stake_amount = abs((float)$request->input('stake_amount'));
            $bet->save();

            if ($bet->id) {
                foreach ($request->input('selections') as $selection) {
                    $betSelection = new BetSelection();
                    $betSelection->lockForUpdate();

                    $betSelection->bet_id = $bet->id;
                    $betSelection->selection_id = $selection['id'];
                    $betSelection->odds = abs((float)$selection['odds']);
                    $betSelection->save();
                }

                $balanceTransaction = new BalanceTransaction();
                $balanceTransaction->lockForUpdate();

                $balanceTransaction->player_id = $player->id;
                $newBalance = (float)$player->balance - abs((float)$request->input('stake_amount'));

                if ($newBalance > 0) {
                    $balanceTransaction->amount_before = $player->balance;
                    $balanceTransaction->amount = $newBalance;
                    $balanceTransaction->save();
                    $player->balance = $newBalance;
                    $player->save();
                } else {
                    throw new \Exception();
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $errors = $validator->special(new Unknown);
            return response()->json([$errors, $e], 400);
        }

        return response()->json([], 201);
    }
}
