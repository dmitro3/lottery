<?php

namespace App\Games\LottoMb\Generators;

use App\Games\Lotto\Base\Generators\BaseMBGenerator;
use App\Games\Lotto\Base\Traits\LottoMbTrait;
use crawlmodule\loterie\XoSoSources\KetQuaNet;
use crawlmodule\loterie\XoSoSources\XoSoMinhNgoc;

class MBMbGenerator extends BaseMBGenerator
{
    use LottoMbTrait;
    public function generate()
    {
        $currentGameRecordId = $this->currentGameRecord->id;
        if ($table = $this->getResultKQXS($this->currentGameRecord)) {
            foreach ($table as $key => $row) {
                foreach ($row as $col) {
                    $CLASS_GAME_TABLE_RESULT = $this->gameLottoProvider->getGameTableResult();
                    $item = new $CLASS_GAME_TABLE_RESULT();
                    $item->game_lotto_play_record_id = $currentGameRecordId;
                    $item->type_prize = $key + 1;
                    $item->value = $col;
                    $item->created_at = now();
                    $item->updated_at = now();
                    $item->save();
                }
            }
        }
    }
    private function getResultKQXS($date)
    {
        $ketquanet = new KetQuaNet($date);
        $result = $ketquanet->getResults();
        if (!$result) {
            $minhngoc = new XoSoMinhNgoc($date);
            $result = $minhngoc->getResults();
        }
        return $result;
    }
}
