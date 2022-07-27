<?php 
namespace realtimemodule\pushserver\Connecters\Games;
use realtimemodule\pushserver\Contracts\ConnecterInterface;
use realtimemodule\pushserver\Helpers\PushServerHelper;
use realtimemodule\pushserver\Models\User;
use App\Games\GoWin\Factories\MiniGameFactory;
use App\Models\Games\Win\{
    GameWinType,
    GameWinMoneyItem
};
use App\Models\{
    WalletTransactionType
};
class GoWinGame implements ConnecterInterface
{
    const END_TIME_CHECK = 5;

    const GAME_CONNECT_STATUS_SUCCESS = 200;
    const GAME_CONNECT_STATUS_NOT_LOGIN = 401;
    const GAME_CONNECT_STATUS_UNKNOWN_ERROR = 603;
    const GAME_CONNECT_STATUS_DATA_NOT_FOUND = 604;
    const GAME_CONNECT_CURRENT_GAME_INVALID = 605;
    const GAME_CONNECT_GAME_DATA_INVALID = 606;
    const GAME_CONNECT_NOT_ENOUGH_MONEY = 607;

    const GAME_ACTION_GET_CURRENT_GAME_TYPE_INFO = 1;
    const GAME_ACTION_DO_BET = 2;

    protected $connection;
    protected $clients;
    protected $connectionList;
    protected $from;
    protected $messageInfo;
    public function setData($connection,$clients,$connectionList,$messageInfo,$from) {
        $this->connection = $connection;
        $this->clients = $clients;
        $this->connectionList = $connectionList;
        $this->messageInfo = $messageInfo;
        $this->from = $from;
    }
    public function response()
    {
        if (!isset($this->connection)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_UNKNOWN_ERROR,false,'Lỗi không xác định.'));
            return $this->connection;
        }
        if (!isset($this->connection['userTargetMessage'])) {
            $userTargetMessage = User::find($this->connection['user_id']);
            if (!isset($userTargetMessage)) {
                $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_NOT_LOGIN,false,'Vui lòng đăng nhập để sử dụng tính năng này.'));
                return $this->connection;
            }
            $this->connection['userTargetMessage'] = $userTargetMessage;
        }
        $action = $this->messageInfo['action'] ?? 0;
        switch ($action) {
            case self::GAME_ACTION_GET_CURRENT_GAME_TYPE_INFO:
                return $this->getCurrentGameTypeInfo($action);
                break;
            case self::GAME_ACTION_DO_BET:
                return $this->doSendBet($action);
                break;
            default:
                return $this->connection;
                break;
        }
        return $this->connection;
    }
    private function _getGameWinType($gameWinTypeId){
        $gameWinType = \Cache::remember('gameWinTypeInfo'.$gameWinTypeId,60, function () use ($gameWinTypeId) {
            return  GameWinType::find($gameWinTypeId);
        });
        return $gameWinType;
    }
    private function getCurrentGameTypeInfo($action){
        $gameWinTypeId = PushServerHelper::unHash($this->messageInfo['game_type']);
        $gameWinType = $this->_getGameWinType($gameWinTypeId);
        if (!isset($gameWinType)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $currentGame = $gameWinType->getCurrentGameRecord();
        if (!isset($currentGame)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $data = [];
        $timeRemaining = $currentGame->getTimeRemaining();
        $data['html'] = view('games.win.current_game_info',compact('currentGame','gameWinType',$timeRemaining))->render();
        $data['time_remaining'] = $timeRemaining;
        $data['game_type'] = $this->messageInfo['game_type'];
        $data['game_type_name'] = $gameWinType->name;
        $data['current_game_idx'] = $currentGame->id;
        $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_SUCCESS,true,'Thành công.',$data,$action));
        return $this->connection;
    }
    private function doSendBet($action){
        $currentGameClientInfo = $this->messageInfo['currentGame'] ?? null;
        if (!isset($currentGameClientInfo)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $gameWinTypeId = PushServerHelper::unHash($currentGameClientInfo['game_type']);
        $gameWinType = $this->_getGameWinType($gameWinTypeId);
        if (!isset($gameWinType)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $currentGame = $gameWinType->getCurrentGameRecord();
        if (!isset($currentGame)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        if ($currentGameClientInfo['current_game_idx'] != $currentGame->id || $currentGame->end_time - now()->timestamp <= self::END_TIME_CHECK) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_CURRENT_GAME_INVALID,false,'Đã hết thời gian đặt cược của ván này.'));
            return $this->connection;
        }
        $qty = isset($this->messageInfo['qty']) ? (int)$this->messageInfo['qty']:0;
        $amoutItem = GameWinMoneyItem::find(PushServerHelper::unHash($this->messageInfo['amount']));
        if ($qty < 1 || $qty > 999 || !isset($amoutItem)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_GAME_DATA_INVALID,false,'Dữ liệu không hợp lệ.'));
            return $this->connection;
        }
        $totalMoney = $qty*$amoutItem->money;
        $user =  $this->connection['userTargetMessage'];
        if ($totalMoney > $user->getAmount()) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_NOT_ENOUGH_MONEY,false,'Số tiền không đủ.'));
            return $this->connection;
        }
        $miniGame = MiniGameFactory::getMiniGame($this->messageInfo['mini_game'] ?? '');
        if (!isset($miniGame)) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_DATA_NOT_FOUND,false,'Game tạm thời không khả dụng.'));
            return $this->connection;
        }
        $miniGame->setValue($this->messageInfo['mini_game_value']);
        if (!$miniGame->validateValue()) {
            $this->from->send($this->buildResponse(self::GAME_CONNECT_GAME_DATA_INVALID,false,'Dữ liệu không hợp lệ.'));
            return $this->connection;
        }

        $itemUserBet = $miniGame->toDatabase($gameWinType,$currentGame,$user,$qty,$amoutItem);
        $reason = vsprintf('Trừ tiền cược game GoWin. Phiên giao dịch %s (%s).',[$currentGame->id,$gameWinType->name]);
        $user->changeMoney(0 - $totalMoney,$reason,WalletTransactionType::MINUS_MONEY_BET_GAME_GOWIN,$itemUserBet->id);

        $data['game_type_name'] = $gameWinType->name;
        $data['game_idx'] = $currentGame->id;
        $data['qty'] = $qty;
        $data['base_amount'] = number_format($itemUserBet->amount_base,0,',','.').' đ';
        $data['amount'] = number_format($itemUserBet->amount,0,',','.').' đ';
        $data['mini_game_name'] = $miniGame->miniGamePreviewName;
        $data['value_select_name'] = $miniGame->getValuePreviewName();
        $data['value'] = $itemUserBet->select_value;
        $this->from->send($this->buildResponse(self::GAME_CONNECT_STATUS_SUCCESS,true,'Thành công.',$data,$action));
        return $this->connection;
    }
    private function buildResponse($code,$status,$message,$data = [],$action = null){
        $dataResponse = [];
        $dataResponse['code'] = $code;
        $dataResponse['success'] = $status;
        $dataResponse['message'] = $message;
        $dataResponse['data'] = $data;
        $dataResponse['action'] = $action;
        return json_encode($dataResponse);
    }
}
