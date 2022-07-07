<?php
namespace App\Models\Games\Win;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\BaseModel;
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
        $canWinNumber = $calculateAmountMap->where('house_income','>',0);

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
        
        $winNumberInfo = $canWinNumber->sortBy('priorityPercentRegulation')->first();
        return $winNumberInfo['number'];
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
}