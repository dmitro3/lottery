<?php

namespace App\Http\Controllers\Games;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoRecord;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;

class GamePlinkoController extends BaseGameController
{

    public function index($request)
    {
        $user = \Auth::user();
        return view('games.plinko.index', compact('user'));
    }
    public function play($request)
    {
        // GamePlinkoType::generateGameRecords();
        $validator = $this->validatorPlayRequest($request);
        if ($validator->fails()) {
            return response()->json([
                'code' => 100,
                'message' => $validator->errors()->first(),
            ]);
        }
        $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
        $user = \Auth::user();
        $betExist = GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecord->id)->where('user_id', $user->id)->count() > 0;
        if ($betExist) {
            return response()->json([
                'code' => 100,
                'message' => 'Bạn đã sẵn sàng, không thể hủy bỏ yêu cầu!',
            ]);
        }
        $bet = new GamePlinkoUserBet();
        $bet->user_id = $user->id;
        $bet->game_plinko_type_id = 1;
        $bet->game_plinko_record_id = $currentGameRecord->id;
        $bet->type = (int)$request->type;
        $bet->mode = $request->mode;
        $bet->qty = $request->qty;
        $bet->save();
        return response()->json([
            'code' => 200,
            'message' => 'Success',
        ]);
    }
    private function validatorPlayRequest($request)
    {
        return \Validator::make($request->all(), [

            'type' => ['required', 'min:' . BallType::NORMAL, 'max:' . BallType::HOT],
            'mode' => ['required', 'in:manual,auto'],
            'qty' => ['required', 'min:1'],
        ], [
            'required' => 'Thông tin :attribute là bắt buộc!',
            'type.min' => 'Vui lòng chọn đúng mức cược',
            'type.max' => 'Vui lòng chọn đúng mức cược',
            'mode.in' => 'Chế độ chơi phải là Tự động hoặc Thủ công'
        ], [
            'type' => 'Mức cược',
            'mode' => 'Chế độ chơi',
            'qty' => 'Số lượng bóng',
        ]);
    }
    private function getAllGameRequest()
    {
        return [
            BallType::NORMAL => 100,
            BallType::MID => 20,
            BallType::HOT => 4
        ];
    }
    private function generateBetResults()
    {
        $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
        $records = GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecord->id)->get();
        $gameRequests = [
            BallType::NORMAL => 0,
            BallType::MID => 0,
            BallType::HOT => 0
        ];
        foreach ($records as $key => $record) {
            $type = $record->type;
            $qty = $record->qty;
            $gameRequests[$type] += $qty;
        }
        $prize = new Prize($gameRequests);
        $prize->generateBetDetails($currentGameRecord->id);
    }
    public function test()
    {
        $detail = GamePlinkoUserBetDetail::inRandomOrder()->limit(1)->first();
        return response()->json([
            'path' => $detail->path,
            'type' => $detail->type
        ]);
    }
}
