<?php

namespace crawlmodule\loterie\XoSoSources;

use crawlmodule\loterie\Contracts\IXoSoSource;

class KetQuaNet extends AXoSoSource
{
    public function getLinkResult()
    {
        return vsprintf('https://ketqua1.net/xo-so-mien-bac.php?ngay=%s', [$this->getTimeString()]);
    }

    protected function crawl($link)
    {
        $html = $this->execCurl($link);
        $htmlDom = str_get_html($html);
        $tableKetQuas = $htmlDom->find('table[id=result_tab_mb]');
        if (count($tableKetQuas) < 1) {
            return false;
        }
        $tableKetQua = $tableKetQuas[0];
        $trList = $tableKetQua->find('tbody tr');
        if (!$trList || count($trList) < 8) return false;
        $dataInsert = [];
        for ($i = 1; $i < count($trList); $i++) {
            $tr = $trList[$i];
            $listDivValue = $tr->find('.phoi-size');
            $dataAdd = [];
            foreach ($listDivValue as $itemDivValue) {
                $dataAdd[] = $itemDivValue->innertext;
            }
            $dataInsert[] = $dataAdd;
        }
        return $dataInsert;
    }
}
