<?php
namespace App\Models\Games\Win;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
use App\Models\WalletTransactionType;
use App\Games\GoWin\Factories\MiniGameFactory;
use Exception;
class GameWinRecord extends BaseModel
{
    use HasFactory;
    public function getTimeRemaining()
    {
        return $this->end_time - now()->timestamp;
    }
    public function gameWinUserBet()
    {
        return $this->hasMany(GameWinUserBet::class);
    }
    public function gameWinType()
    {
        return $this->belongsTo(GameWinType::class);
    }
    public function initWinNumber()
    {
        $listGameWinUserBet = $this->gameWinUserBet()->select('mini_game','select_value','amount')->get();
        $totalIncomeAmount = $listGameWinUserBet->sum('amount');
        $arrGameWinUserBet = $listGameWinUserBet->toArray();
        $calculateAmountMap = collect();
        for ($i=0; $i <= 9; $i++) {
            $dataAdd = $this->_calculateAmountExample($i,$arrGameWinUserBet,$totalIncomeAmount);
            $dataAdd['number'] = $i;
            $calculateAmountMap->push($dataAdd);
        }
        $canWinNumber = $calculateAmountMap->where('house_income','>=',0);

        if (count($canWinNumber) < 1) {
            throw new Exception("Hệ thống bị lỗi");
           /**
            * Như này nhà cái auto lỗ bỏ web thôi;
            */
        }

        /**
         * priorityPercentRegulation là độ ưu tiên tỉ lệ phần trăm nhà cái được hưởng. Càng bé thì càng gần đúng với tỉ lệ đặt ra.
         * Nếu muốn lấy theo tỉ lệ đặt ra thì sẽ lấy theo số nào có priorityPercentRegulation bé nhất.
         * Nếu muốn lấy nhiều nhất có thể thì sẽ lấy theo house_income lớn nhất.
         */
        
        $expectedWinNumberInfo = $canWinNumber->sortBy('priorityPercentRegulation')->first();

        /**
         * $expectedWinNumberInfo Là số dự kiến sẽ thắng.
         * Phần này để dự phòng trường hợp ko ai chơi thì priorityPercentRegulation của tất cả các số sẽ bằng nhau. Mình cần random để tránh trường hợp 1 số thắng liên tiếp .
         */
       
        $arrNumberSamePriorityPercentRegulation = $canWinNumber->where('priorityPercentRegulation',$expectedWinNumberInfo['priorityPercentRegulation']);
        $winNumberInfo = $arrNumberSamePriorityPercentRegulation->random(1)->first();
        $this->win_number = $winNumberInfo['number'];
        $this->ready_to_end = 1;
        $this->save();
    }
    private function _calculateAmountExample($winNumberExample,$arrGameWinUserBet,$totalIncomeAmount){
        $totalAmountReturnUser = 0;
        $totalUserWinAmountOutlay = 0;
        for ($i=0; $i < count($arrGameWinUserBet); $i++) { 
            $itemGameWinUserBet = $arrGameWinUserBet[$i];
            $miniGame = MiniGameFactory::getMiniGame($itemGameWinUserBet['mini_game']);
            if (!isset($miniGame)) {
                continue;
            }
            $miniGame->setValue($itemGameWinUserBet['select_value']);
            if ($miniGame->isWin($winNumberExample)) {
                $amountExample = $miniGame->calculationAmountWin($winNumberExample,$itemGameWinUserBet['amount']);
                $totalAmountReturnUser += $amountExample;
                $totalUserWinAmountOutlay += $itemGameWinUserBet['amount'];
            }
        }
        $ret = [];
        $totalUserLostAmount = $totalIncomeAmount - $totalUserWinAmountOutlay;

        /**
         * $winRatio là tỉ lệ giữa số tiền trả về người dùng thắng / số tiền người dùng thua.
         */
        
        $winRatio = 100*($totalUserLostAmount > 0 ? $totalAmountReturnUser/$totalUserLostAmount:0);
        $phanTramNhaCaiMuonAn = 20;

        $priorityPercentRegulation = abs(1 - (100 - $winRatio)/$phanTramNhaCaiMuonAn);
        $ret['house_income'] = $totalIncomeAmount - $totalAmountReturnUser;
        $ret['priorityPercentRegulation'] = $priorityPercentRegulation;
        return $ret;
    }
    public function end()
    {
        $this->fresh();
        if ($this->win_number == '' || $this->is_end == 1) {
            return false;
        }
        $listUserBet = $this->gameWinUserBet()
                            ->whereHas('user')
                            ->with('user')
                            ->where('game_win_user_bet_status_id',GameWinUserBetStatus::STATUS_WAIT_RESULT)
                            ->where('is_returned',0)
                            ->get();
        foreach ($listUserBet as $itemUserBet) {
            $miniGame = MiniGameFactory::getMiniGame($itemUserBet->mini_game);
            if (!isset($miniGame)) {
                continue;
            }
            $miniGame->setValue($itemUserBet->select_value);
            if ($miniGame->isWin($this->win_number)) {
                $amountReturnUser = $miniGame->calculationAmountWin($this->win_number,$itemUserBet['amount']);
                $user = $itemUserBet->user;
                $reason = vsprintf('Cộng tiền thắng game GoWin. Phiên giao dịch %s %s.',[$this->id,isset($this->gameWinType) ? '('.$this->gameWinType->name.')':'']);
                $user->changeMoney($amountReturnUser,$reason,WalletTransactionType::PLUS_MONEY_WIN_GAME_GOWIN,$itemUserBet->id);
                $itemUserBet->return_amount = $amountReturnUser;
                $itemUserBet->is_returned = 1;
                $itemUserBet->game_win_user_bet_status_id = GameWinUserBetStatus::STATUS_WIN;
                $itemUserBet->save();
            }else{
                $itemUserBet->game_win_user_bet_status_id = GameWinUserBetStatus::STATUS_LOSE;
                $itemUserBet->save();
            }
        }
        $this->is_end = 1;
        $this->save();
    }
}