<?php

namespace realtimemodule\pushserver\Connecters\Games;

use realtimemodule\pushserver\Contracts\ConnecterInterface;
use realtimemodule\pushserver\Models\User;

use App\Games\Plinko\Enums\Bag;
use App\Games\Plinko\Enums\BallType;
use App\Games\Plinko\Prize;
use App\Models\Games\Plinko\GamePlinkoPath;
use App\Models\Games\Plinko\GamePlinkoRecord;
use App\Models\Games\Plinko\GamePlinkoType;
use App\Models\Games\Plinko\GamePlinkoUserBet;
use App\Models\Games\Plinko\GamePlinkoUserBetDetail;
use \realtimemodule\pushserver\Enums\Plinko\Status as PlinkoStatus;


class PlinkoConnector implements ConnecterInterface
{


    protected $connection;
    protected $clients;
    protected $connectionList;
    protected $from;
    protected $messageInfo;
    public function setData($connection, $clients, $connectionList, $messageInfo, $from)
    {
        $this->connection = $connection;
        $this->clients = $clients;
        $this->connectionList = $connectionList;
        $this->messageInfo = $messageInfo;
        $this->from = $from;
    }
    public function response()
    {
        if (!isset($this->connection)) {
            $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_UNKNOWN_ERROR, false, 'Lỗi không xác định.'));
            return $this->connection;
        }
        if (!isset($this->connection['userTargetMessage'])) {
            $userTargetMessage = User::find($this->connection['user_id']);
            if (!isset($userTargetMessage)) {
                $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_NOT_LOGIN, false, 'Vui lòng đăng nhập để sử dụng tính năng này.'));
                return $this->connection;
            }
            $this->connection['userTargetMessage'] = $userTargetMessage;
        }
        $action = $this->messageInfo['action'] ?? 0;
        switch ($action) {
            case PlinkoStatus::GAME_ACTION_GET_CURRENT_GAME_INFO:
                return $this->getCurrentGameTypeInfo($action);
                break;
            case PlinkoStatus::GAME_ACTION_DO_BET:
                return $this->play($action);
                break;
            default:
                return $this->connection;
                break;
        }
        return $this->connection;
    }
    private function getCurrentGameTypeInfo($action)
    {
        $gamePlinkoType = GamePlinkoType::find(1);
        if (!isset($gamePlinkoType)) {
            $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $currentGame = $gamePlinkoType->getCurrentGameRecord();
        if (!isset($currentGame)) {
            $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $data = [];
        $timeRemaining = $currentGame->getTimeRemaining();
        $data['html'] = view('games.plinko.current_game_info', compact('currentGame', 'gamePlinkoType', $timeRemaining))->render();
        $data['time_remaining'] = $timeRemaining;
        $data['current_game_idx'] = $currentGame->id;
        $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_SUCCESS, true, 'Thành công.', $data, $action));
        return $this->connection;
    }
    private function validatorPlayRequest($data)
    {
        return \Validator::make($data, [

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
    public function play($action)
    {
        $currentGameClientInfo = $this->messageInfo['currentGame'] ?? null;
        $gameData = $this->messageInfo['gameData'] ?? null;
        if (!isset($currentGameClientInfo) || !isset($gameData)) {
            $this->from->send($this->buildResponse(PlinkoStatus::GAME_CONNECT_STATUS_DATA_NOT_FOUND, false, 'Game tạm thời không khả dụng.'));
        }
        $validator = $this->validatorPlayRequest($gameData);
        if ($validator->fails()) {
            $this->from->send($this->buildResponse(100, false, $validator->errors()->first()));
            return $this->connection;
        }
        $currentGameRecord = GamePlinkoType::find(1)->getCurrentGameRecord();
        $user = $this->connection['userTargetMessage'];
        $betExist = GamePlinkoUserBet::where('game_plinko_record_id', $currentGameRecord->id)->where('user_id', $user->id)->count() > 0;
        if ($betExist) {
            $this->from->send($this->buildResponse(100, false, 'Bạn đã sẵn sàng, không thể hủy bỏ yêu cầu!'));
            return $this->connection;
        }

        // kiểm tra tiền và trừ tiền user. A hưng chưa code !! Siêu quan trọng !! <<<<


        $bet = new GamePlinkoUserBet();
        $bet->user_id = $user->id;
        $bet->game_plinko_type_id = 1;
        $bet->game_plinko_record_id = $currentGameRecord->id;
        $bet->type = (int)$gameData['type'];
        $bet->mode = $gameData['mode'];
        $bet->qty = $gameData['qty'];
        $bet->save();
        $this->from->send($this->buildResponse(200, true, 'Đặt hàng thành công!', [], $action));
        return $this->connection;
    }
    private function buildResponse($code, $status, $message, $data = [], $action = null)
    {
        $dataResponse = [];
        $dataResponse['code'] = $code;
        $dataResponse['success'] = $status;
        $dataResponse['message'] = $message;
        $dataResponse['data'] = $data;
        $dataResponse['action'] = $action;
        return json_encode($dataResponse);
    }
}
