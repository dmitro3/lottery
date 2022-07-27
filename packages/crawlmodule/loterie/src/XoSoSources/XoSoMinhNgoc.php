<?php

namespace crawlmodule\loterie\XoSoSources;


class XoSoMinhNgoc extends AXoSoSource
{
    public function getLinkResult()
    {
        return vsprintf('https://www.minhngoc.net/ket-qua-xo-so/mien-bac/%s.html', [$this->getTimeString()]);
    }
    protected function crawl($link)
    {
        $html = $this->execCurl($link);
        $htmlDom = str_get_html($html);
        $tableKetQuas = $htmlDom->find('.bkqtinhmienbac');
        if (count($tableKetQuas) < 1) {
            return false;
        }
        $tableKetQua = $tableKetQuas[0];
        $trList = $tableKetQua->find('tbody tr');
        $dataInsert = [];
        if (!$trList || count($trList) < 8) return false;

        for ($i = 1; $i < count($trList); $i++) {
            $tr = $trList[$i];
            $listDivValue = $tr->find('div');
            if (!$listDivValue) {
                continue;
            }
            $dataAdd = [];
            foreach ($listDivValue as $itemDivValue) {
                $dataAdd[] = $itemDivValue->innertext;
            }
            $dataInsert[] = $dataAdd;
        }
        return $dataInsert;
    }
}
