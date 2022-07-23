<?php

namespace App\Models\Games\Plinko;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\V2\PrizeBagMktCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\User;

class GamePlinkoUserBetDetail extends BaseModel
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function retreiveOne($user, GamePlinkoRecord $currentGameRecord, GamePlinkoUserBet $userBet, BallType $ball)
    {
        $ballType = $ball->getValue();
        if ($user->is_marketing_account == 0) {
            $game = static::getGameForNormalAccount($currentGameRecord, $ballType);
        } else {
            $game = static::getGameForMarketingAccount($currentGameRecord, $ballType);
        }

        $baseAmount = $ball->getBetAmount();
        $amount = $baseAmount * 1;
        $bagValue = $game->bag_value;
        $subtotal = $bagValue * $amount;

        $game->game_plinko_user_bet_id = $userBet->id;
        $game->user_id = $user->id;
        $game->is_checked = 1;
        $game->amount_base = $baseAmount;
        $game->amount = $amount;
        $game->return_amount = $subtotal;
        $game->save();

        return $game;
    }
    private static function getGameForNormalAccount($currentGameRecord, $ballType)
    {

        $count = static::where('game_plinko_record_id', $currentGameRecord->id)->where('is_checked', 0)->where('type', $ballType)->count();
        if ($count > 0) {
            $game = static::where('game_plinko_record_id', $currentGameRecord->id)->where('is_checked', 0)->where('is_residual', 0)->where('type', $ballType)->inRandomOrder()->first();
            if (!$game) {
                $game = static::where('game_plinko_record_id', $currentGameRecord->id)->where('is_checked', 0)->where('type', $ballType)->inRandomOrder()->first();
            }
        } else {
            $bag = Bag::BAG9();
            $path = GamePlinkoPath::whereIn('start', [16, 18])->whereIn('dest', [$bag->getBagIndexs()])->inRandomOrder()->limit(1)->first();
            $game = new static;
            $game->game_plinko_type_id = 1;
            $game->game_plinko_record_id = $currentGameRecord->id;
            $game->created_at = now();
            $game->updated_at = now();
            $game->type = $ballType;
            $game->path = $path->path;
            $game->start = $path->start;
            $game->dest = $path->dest;
            $game->game_plinko_path_id = $path->id;
            $game->zigzag = $path->zigzag;
            $game->is_residual = 1;
            $game->is_from_account_marketing = 0;
            $game->bag_name = $bag->getName();
            $game->bag_value = $bag->getValue();
        }
        return $game;
    }
    private static function getGameForMarketingAccount($currentGameRecord, $ballType)
    {
        $bag = PrizeBagMktCollection::getInstance()->randomBag();
        $path = GamePlinkoPath::whereIn('start', [16, 18])->whereIn('dest', [$bag->getBagIndexs()])->inRandomOrder()->limit(1)->first();
        $game = new static;
        $game->game_plinko_type_id = 1;
        $game->game_plinko_record_id = $currentGameRecord->id;
        $game->created_at = now();
        $game->updated_at = now();
        $game->type = $ballType;
        $game->path = $path->path;
        $game->start = $path->start;
        $game->dest = $path->dest;
        $game->game_plinko_path_id = $path->id;
        $game->zigzag = $path->zigzag;
        $game->is_residual = 1;
        $game->is_from_account_marketing = 1;
        $game->bag_name = $bag->getName();
        $game->bag_value = $bag->getValue();
        return $game;
    }
}
